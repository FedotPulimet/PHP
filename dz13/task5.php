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

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Категории продуктов</title>
<style>
.category { cursor: pointer; margin: 10px 0; }
.filters { display: none; margin-left: 20px; }
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
</script>
</head>
<body>

<h1>Список категорий</h1>

<?php foreach ($categories as $category): ?>
   <div class="category" onclick="toggleFilters('<?php echo strtolower(str_replace(' ', '_', $category->getName())); ?>')">
       <?php echo $category->getName(); ?>
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
           <label><?php echo "$filter:"; ?></label>
           <input type="number" placeholder="min: <?php echo isset($minValue) ? $minValue : ''; ?>" />
           <input type="number" placeholder="max: <?php echo isset($maxValue) ? $maxValue : ''; ?>" />
           <br/>
       <?php endforeach; ?>
   </div>
<?php endforeach; ?>

</body>
</html>