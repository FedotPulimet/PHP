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
    ["name" => "iPhone 13", "type" => "Phone"],
    ["name" => "Samsung Galaxy S21", "type" => "Phone"],
    ["name" => "LG 27UL850", "type" => "Monitor"],
    ["name" => "Samsung Odyssey G7", "type" => "Monitor"]
];

foreach ($products as $product) {
    foreach ($categories as $category) {
        if ($product['type'] === 'Phone' && get_class($category) === 'PhoneCategory') {
            $category->addProduct($product['name']);
        } elseif ($product['type'] === 'Monitor' && get_class($category) === 'MonitorCategory') {
            $category->addProduct($product['name']);
        }
    }
}

foreach ($categories as $category) {
    echo "Категория: " . $category->getName() . "\n";
    echo "Продукты: " . implode(", ", $category->getListProducts()) . "\n";
}
?>