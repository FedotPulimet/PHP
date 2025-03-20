<?php
$data = [
    ['type' => 'type1', 'value' => 'value1'],
    ['type' => 'type2', 'value' => 'value2'],
    ['type' => 'type3', 'value' => 'value3'],
    ['type' => 'type4', 'value' => 'value4'],
    ['type' => 'type5', 'value' => 'value5'],
    ['type' => 'type6', 'value' => 'value6'],
    ['type' => 'type7', 'value' => 'value7'],
    ['type' => 'type8', 'value' => 'value8'],
    ['type' => 'type9', 'value' => 'value9'],
    ['type' => 'type10', 'value' => 'value10'],
];

foreach ($data as $item) {
    echo "Type: " . $item['type'] . ", Value: " . $item['value'] . "<br>";
}
?>