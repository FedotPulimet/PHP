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
            <li><?php echo htmlspecialchars($category->getCategoryName()) . ": " . implode(", ", $category->getCategoryProducts()); ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Список продуктов</h2>
    <ul>
        <?php foreach ($_SESSION['products'] as $product): ?>
            <li><?php echo htmlspecialchars($product); ?></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>