<?php

class Category {
    private $name;
    private $filters;
    private $listProducts;

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

$category = new Category("Электроника", ["Brand", "Color"]);
echo "Имя категории: " . $category->getName() . "\n";
echo "Фильтры: " . implode(", ", $category->getFilters()) . "\n";

$category->addProduct("Телефон");
$category->addProduct("Ноутбук");

echo "Продукты в категории: " . implode(", ", $category->getListProducts()) . "\n";
?>