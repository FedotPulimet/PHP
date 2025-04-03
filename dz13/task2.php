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

$phoneCategory = new PhoneCategory("Смартфоны");
echo "Имя категории: " . $phoneCategory->getName() . "\n";
echo "Фильтры: " . implode(", ", $phoneCategory->getFilters()) . "\n";

$phoneCategory->addProduct("iPhone 13");
$phoneCategory->addProduct("Samsung Galaxy S21");

echo "Продукты в категории: " . implode(", ", $phoneCategory->getListProducts()) . "\n";
?>