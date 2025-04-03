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

    <h2>Поиск категории</h2>
    
    <form method="post" action="">
        <input type="text" name="search_name" placeholder="Название для поиска" required>
        <button type="submit">Поиск</button>
    </form>

    <?php if ($foundCategory): ?>
        <h3>Найдена категория:</h3>
        <p><?php echo htmlspecialchars($foundCategory->getCategoryName()) . ": " . implode(", ", $foundCategory->getCategoryProducts()); ?></p>
    <?php elseif (isset($_POST['search_name'])): ?>
        <h3>Категория не найдена.</h3>
    <?php endif; ?>

</body>
</html>