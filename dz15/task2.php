<?php
class Input {
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

class Checkbox extends Input {
    private $isChecked;
    public function __construct($background, $width, $height, $name, $value, $_isChecked) {
        parent::__construct($background, $width, $height, $name, $value);
        if ($_isChecked === true || $_isChecked === "true") {
            $this->setCheckedState();
        } else {
            if ($_isChecked === false || $_isChecked === "false") {
                $this->setCheckedState(false);
            }
        }
    }

    public function getCheckedState() {
        return $this->isChecked; 
    }

    public function setCheckedState($state = true) {
        if ($state === true || strtolower($state) === "true") {
            $this->isChecked = "true";
        } else {
            $this->isChecked = "false";
        }
    }

    public function render() {
        return sprintf(
            '<input type="checkbox" name="%s" value="%s" style="background:%s; width:%dpx; height:%dpx;" %s>',
            htmlspecialchars($this->name),
            htmlspecialchars($this->value),
            htmlspecialchars($this->background),
            intval($this->width),
            intval($this->height),
            ($this->getCheckedState() === "true") ? 'checked' : ''
        );
    }
}

$checkbox1 = new Checkbox("white", 20, 20, "subscribe", "yes", true);
$checkbox2 = new Checkbox("white", 20, 20, "subscribe", "no", false);

echo $checkbox1->render() . "<br>";
echo $checkbox2->render();
?>