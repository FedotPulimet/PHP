<?php
class Control {
    protected $background;
    protected $width;
    protected $height;
    protected $name;
    protected $value;

    public function __construct($background, $width, $height, $name, $value) {
        $this->background = $background;
        $this->width = $width;
        $this->height = $height;
        $this->name = $name;
        $this->value = $value;
    }
}

class Select extends Control {
    private $items = []; 

    public function __construct($background, $width, $height, $name, $value, array $_items) {
        parent::__construct($background, $width, $height, $name, $value);
        $this->setItems($_items);
    }

    public function getItems() {
        return $this->items;
    }

    public function setItems(array $_items) {
        foreach ($_items as $item) {
            if (!is_string($item)) {
                throw new InvalidArgumentException("Все элементы должны быть строками");
            }
        }
        $this->items = $_items;
    }

    public function render() {
        $html = sprintf(
            '<select name="%s" style="background:%s; width:%dpx; height:%dpx;">',
            htmlspecialchars($this->name),
            htmlspecialchars($this->background),
            intval($this->width),
            intval($this->height)
        );

        foreach ($this->items as $item) {
            $selected = ($item === $this->value) ? ' selected' : '';
            $html .= sprintf(
                '<option value="%s"%s>%s</option>',
                htmlspecialchars($item),
                $selected,
                htmlspecialchars($item)
            );
        }

        $html .= '</select>';

        return $html;
    }
}

$select = new Select("white", 200, 30, "fruits", "Apple", ["Apple", "Banana", "Cherry"]);
echo $select->render();
?>