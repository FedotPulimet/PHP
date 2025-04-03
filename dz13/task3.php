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

class MonitorCategory extends Category {

    public function __construct($name) {
        $monitorFilters = ["Diagonal", "Frequency"];

        parent::__construct($name, $monitorFilters);
    }
}

$monitorCategory = new MonitorCategory("Мониторы");
echo "Имя категории: " . $monitorCategory->getName() . "\n";
echo "Фильтры: " . implode(", ", $monitorCategory->getFilters()) . "\n";

$monitorCategory->addProduct("LG 27UL850");
$monitorCategory->addProduct("Samsung Odyssey G7");

echo "Продукты в категории: " . implode(", ", $monitorCategory->getListProducts()) . "\n";
?>