<?php

function calculate($num1, $num2, $operation) {
    switch ($operation) {
        case 'add':
            return $num1 + $num2;
        case 'subtract':
            return $num1 - $num2;
        case 'multiply':
            return $num1 * $num2;
        case 'divide':
            if ($num2 == 0) {
                return "Ошибка: Деление на ноль невозможно.";
            }
            return $num1 / $num2;
        default:
            return "Ошибка: Некорректное действие.";
    }
}

echo calculate(10, 5, 'add') . "\n";      
echo calculate(10, 5, 'subtract') . "\n";   
echo calculate(10, 5, 'multiply') . "\n";   
echo calculate(10, 0, 'divide') . "\n";    
echo calculate(10, 5, 'unknown') . "\n"; 

?>