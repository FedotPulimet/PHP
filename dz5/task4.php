<?php
$shapes = [
    ['name' => 'Квадрат', 'x' => 50, 'y' => 50, 'color' => 'red'],
    ['name' => 'Круг', 'x' => 150, 'y' => 50, 'color' => 'blue'],
    ['name' => 'Треугольник', 'x' => 250, 'y' => 50, 'color' => 'green'],
    ['name' => 'Прямоугольник', 'x' => 350, 'y' => 50, 'color' => 'orange'],
    ['name' => 'Эллипс', 'x' => 450, 'y' => 50, 'color' => 'purple'],
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рисование фигур</title>
    <h1>Рисование</h1>
    <style>
        .shape {
            position: absolute;
        }
        .square {
            width: 50px;
            height: 50px;
        }
        .circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .triangle {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 50px solid;
        }
        .rectangle {
            width: 100px;
            height: 50px;
        }
        .ellipse {
            width: 100px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<?php
foreach ($shapes as $shape) {
    echo '<div class="shape ' . strtolower($shape['name']) . '" style="background-color: ' . $shape['color'] . '; left: ' . $shape['x'] . 'px; top: ' . $shape['y'] . 'px;">';

    if ($shape['name'] === 'Треугольник') {
        echo '<style>.triangle { border-bottom-color: ' . $shape['color'] . '; }</style>';
    }

    echo '</div>';
}
?>

</body>
</html>