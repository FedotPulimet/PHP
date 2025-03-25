<?php

function buildMenu($menuItems) {
    $menuHtml = "<ul style=\"list-style-type: none; padding: 0; margin: 0;\">\n";

    foreach ($menuItems as $item) {
        if (is_array($item) && isset($item['text']) && isset($item['class'])) {
            $text = htmlspecialchars($item['text']); 
            $class = htmlspecialchars($item['class']); 
            $menuHtml .= "    <li class=\"$class\" style=\"padding: 10px; margin: 5px 0; background-color: #f0f0f0; border-radius: 5px;\">\n";
            $menuHtml .= "        <a href=\"#\" style=\"text-decoration: none; color: #333;\">$text</a>\n";
            $menuHtml .= "    </li>\n"; 
        } else {
            return "Ошибка: Каждый пункт меню должен быть массивом с ключами 'text' и 'class'.";
        }
    }

    $menuHtml .= "</ul>\n";

    return $menuHtml; 
}

$menuItems = [
    ['text' => 'Главная', 'class' => 'menu-item'],
    ['text' => 'О нас', 'class' => 'menu-item'],
    ['text' => 'Услуги', 'class' => 'menu-item'],
    ['text' => 'Контакты', 'class' => 'menu-item'],
];

echo buildMenu($menuItems);

?>