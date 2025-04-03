<?php

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

    public function setName($name) {
        $this->name = $name;
    }

    public function addProduct($product) {
        $this->list_products[] = $product;
    }

    public function removeProduct($product) {
        if (($key = array_search($product, $this->list_products)) !== false) {
            unset($this->list_products[$key]);
        }
    }
}

$category = new Category("Электроника", ["Телефон", "Ноутбук"]);
echo "Категория: " . $category->getCategoryName() . "\n";
echo "Продукты: " . implode(", ", $category->getCategoryProducts()) . "\n";

$category->addProduct("Планшет");
echo "Обновленный список продуктов: " . implode(", ", $category->getCategoryProducts()) . "\n";

$category->removeProduct("Телефон");
echo "Список продуктов после удаления: " . implode(", ", $category->getCategoryProducts()) . "\n";
?>