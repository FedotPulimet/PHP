<?php

class Category {
    private $name;
    private $list_products;

    public function __construct($name, $list_products = []) {
        $this->name = $name;
        $this->list_products = $list_products;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getListProducts() {
        return $this->list_products;
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
echo "Категория: " . $category->getName() . "\n";
echo "Продукты: " . implode(", ", $category->getListProducts()) . "\n";

$category->addProduct("Планшет");
echo "Обновленный список продуктов: " . implode(", ", $category->getListProducts()) . "\n";

$category->removeProduct("Телефон");
echo "Список продуктов после удаления: " . implode(", ", $category->getListProducts()) . "\n";
?>