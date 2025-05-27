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

class Radio extends Input {
    private $isChecked; 
    public function __construct($background, $width, $height, $name, $value, $_isChecked) {
        parent::__construct($background, $width, $height, $name, $value);
        if ($_isChecked === true || $_isChecked === "true") {
            $this->setCheckedState();
        } else {
            if ($_isChecked === false || $_isChecked === "false") {
                if ($_isChecked === false || $_isChecked === "false") {
                    $this->setCheckedState(false);
                }
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
            '<input type="radio" name="%s" value="%s" style="background:%s; width:%dpx; height:%dpx;" %s>',
            htmlspecialchars($this->name),
            htmlspecialchars($this->value),
            htmlspecialchars($this->background),
            intval($this->width),
            intval($this->height),
            ($this->getCheckedState() === "true") ? 'checked' : ''
        );
    }
}

$radio1 = new Radio("white", 20, 20, "gender", "male", true);
$radio2 = new Radio("white", 20, 20, "gender", "female", false);

echo $radio1->render() . "<br>";
echo $radio2->render();
?>