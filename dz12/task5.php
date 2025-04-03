<?php
session_start();

if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [];
}

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = ["Телефон", "Ноутбук", "Планшет"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_name'])) {
    $categoryName = trim($_POST['category_name']);
    
    if (!empty($categoryName)) {
        $newCategory = new Category($categoryName, $_SESSION['products']);
        $_SESSION['categories'][] = $newCategory;

        $_SESSION['products'] = [];
    }
}

$foundCategory = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_name'])) {
    $searchName = trim($_POST['search_name']);
    
    if (!empty($searchName)) {
        $foundCategory = Category::findCategoryByName($_SESSION['categories'], $searchName);
    }
}

$selectedCategory = null;
if (isset($_GET['category_name'])) {
    $selectedCategory = Category::findCategoryByName($_SESSION['categories'], $_GET['category_name']);
}

class Category {
    private $name;
    private $list_products;

    public function __construct($name, $list_products = []) {
        $this->name = $name;
        $this->list_products = $list_products;
    }

    public function getCategoryName() {
        return $this->name;
    }

    public function getCategoryProducts() {
        return $this->list_products;
    }

    public static function findCategoryByName($categories, $name) {
        foreach ($categories as $category) {
            if ($category->getCategoryName() === $name) {
                return $category;
            }
        }
        return null; 
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категории и Продукты</title>
</head>
<body>
    <h1>Добавить категорию</h1>
    
    <form method="post" action="">
        <input type="text" name="category_name" placeholder="Название категории" required>
        <button type="submit">Add</button>
    </form>

    <h2>Список категорий</h2>
    <ul>
        <?php foreach ($_SESSION['categories'] as $category): ?>
            <li>
                <a href="?category_name=<?php echo urlencode($category->getCategoryName()); ?>">
                    <?php echo htmlspecialchars($category->getCategoryName()); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($selectedCategory): ?>
        <h3>Продукты в категории "<?php echo htmlspecialchars($selectedCategory->getCategoryName()); ?>"</h3>
        <ul>
            <?php foreach ($selectedCategory->getCategoryProducts() as $product): ?>
                <li><?php echo htmlspecialchars($product); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>
</html>