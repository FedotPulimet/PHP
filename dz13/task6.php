<?php

class Category {
    protected $name;
    protected $filters;
    protected $listProducts;

    public function __construct($name, $filters = []) {
        $this->name = $name;
        $this->filters = array_merge($filters, ["Price"]);
        $this->listProducts = []; 
    }

    public function getName() {
        return $this->name;
    }

    public function getFilters() {
        return $this->filters;
    }

    public function getListProducts() {
        return $this->listProducts;
    }

    public function addProduct($product) {
        $this->listProducts[] = $product;
    }
}

class PhoneCategory extends Category {

    public function __construct($name) {
        $phoneFilters = ["Ram", "CountSim", "Hdd", "OS"];

        parent::__construct($name, $phoneFilters);
    }
}

class MonitorCategory extends Category {

    public function __construct($name) {
        $monitorFilters = ["Diagonal", "Frequency"];

        parent::__construct($name, $monitorFilters);
    }
}

$categories = [
    new PhoneCategory("Смартфоны"),
    new MonitorCategory("Мониторы")
];

$products = [
    ["name" => "iPhone 13", "type" => "Phone", "ram" => 4, "hdd" => 128],
    ["name" => "Samsung Galaxy S21", "type" => "Phone", "ram" => 8, "hdd" => 256],
    ["name" => "LG 27UL850", "type" => "Monitor", "diagonal" => 27, "frequency" => 60],
    ["name" => "Samsung Odyssey G7", "type" => "Monitor", "diagonal" => 27, "frequency" => 240]
];

foreach ($products as $product) {
    foreach ($categories as $category) {
        if ($product['type'] === 'Phone' && get_class($category) === 'PhoneCategory') {
            $category->addProduct($product);
        } elseif ($product['type'] === 'Monitor' && get_class($category) === 'MonitorCategory') {
            $category->addProduct($product);
        }
    }
}

function getMinMaxValues($products, $key) {
    if (empty($products)) return [null, null];

    $values = array_column($products, $key);
    
    return [min($values), max($values)];
}

$filteredProducts = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   foreach ($categories as $category) {
       foreach ($category->getListProducts() as $product) {
           if (
               (isset($_POST['ram_min']) && $_POST['ram_min'] !== '' && $product['ram'] < $_POST['ram_min']) ||
               (isset($_POST['ram_max']) && $_POST['ram_max'] !== '' && $product['ram'] > $_POST['ram_max']) ||
               (isset($_POST['hdd_min']) && $_POST['hdd_min'] !== '' && $product['hdd'] < $_POST['hdd_min']) ||
               (isset($_POST['hdd_max']) && $_POST['hdd_max'] !== '' && $product['hdd'] > $_POST['hdd_max']) ||
               (isset($_POST['diagonal_min']) && $_POST['diagonal_min'] !== '' && isset($product['diagonal']) && $product['diagonal'] < $_POST['diagonal_min']) ||
               (isset($_POST['diagonal_max']) && $_POST['diagonal_max'] !== '' && isset($product['diagonal']) && $product['diagonal'] > $_POST['diagonal_max'])
           ) {
               continue; 
           }
           if (!in_array($product, $filteredProducts)) {
               array_push($filteredProducts, $product);
           }
       }
   }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Категории продуктов</title>
<style>
.category { cursor: pointer; margin: 10px 0; }
.filters { display: none; margin-left: 20px; }
button:disabled { background-color: #ccc; cursor: not-allowed; }
</style>
<script>
function toggleFilters(categoryId) {
   var filtersDiv = document.getElementById(categoryId);
   if (filtersDiv.style.display === 'none' || filtersDiv.style.display === '') {
       filtersDiv.style.display = 'block';
   } else {
       filtersDiv.style.display = 'none';
   }
}

function enableSubmitButton() {
   const inputs = document.querySelectorAll('.filter-input');
   const submitButton = document.getElementById('submit-button');
   let isAnyInputFilled = false;

   inputs.forEach(input => {
       if (input.value !== '') isAnyInputFilled = true;
   });

   submitButton.disabled = !isAnyInputFilled;
}
</script>
</head>
<body>

<h1>Список категорий</h1>

<form method="post">
<?php foreach ($categories as $category): ?>
   <div class="category" onclick="toggleFilters('<?php echo strtolower(str_replace(' ', '_', $category->getName())); ?>')">
       <?php echo htmlspecialchars($category->getName()); ?>
   </div>
   <div class="filters" id="<?php echo strtolower(str_replace(' ', '_', $category->getName())); ?>">
       <h3>Фильтры:</h3>
       <?php foreach ($category->getFilters() as $filter): ?>
           <?php 
           if ($filter === 'Ram') {
               list($minValue, $maxValue) = getMinMaxValues($category->getListProducts(), 'ram');
           } elseif ($filter === 'Hdd') {
               list($minValue, $maxValue) = getMinMaxValues($category->getListProducts(), 'hdd');
           } elseif ($filter === 'Diagonal') {
               list($minValue, $maxValue) = getMinMaxValues($category->getListProducts(), 'diagonal');
           } elseif ($filter === 'Frequency') {
               list($minValue, $maxValue) = getMinMaxValues($category->getListProducts(), 'frequency');
           } else {
               continue; 
           }
           ?>
           <label><?php echo htmlspecialchars("$filter:"); ?></label>
           <input type="number" name="<?php echo strtolower(substr($filter, 0, -1)); ?>_min" class="filter-input" placeholder="min: <?php echo isset($minValue) ? htmlspecialchars($minValue) : ''; ?>" oninput="enableSubmitButton()" />
           <input type="number" name="<?php echo strtolower(substr($filter, 0, -1)); ?>_max" class="filter-input" placeholder="max: <?php echo isset($maxValue) ? htmlspecialchars($maxValue) : ''; ?>" oninput="enableSubmitButton()" />
           <br/>
       <?php endforeach; ?>
   </div>
<?php endforeach; ?>

<button type="submit" id="submit-button" disabled>Показать продукты</button>
</form>

<h2>Результаты:</h2>
<ul>
<?php if (!empty($filteredProducts)): ?>
   <?php foreach ($filteredProducts as $product): ?>
       <li><?php echo htmlspecialchars($product["name"]); ?></li>
   <?php endforeach; ?>
<?php else: ?>
   <li>Нет подходящих продуктов.</li>
<?php endif; ?>
</ul>

</body>
</html>