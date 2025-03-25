<?php

function createHtmlElement($tag, $class) {
    $validTags = ['div', 'span', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'a', 'ul', 'li', 'table', 'tr', 'td', 'th', 'header', 'footer', 'section', 'article'];

    if (!in_array($tag, $validTags)) {
        return "Ошибка: Некорректный HTML-тег.";
    }

    return "<$tag class=\"$class\">Содержимое элемента $tag</$tag>";
}

echo createHtmlElement('div', 'my-class') . "\n";   
echo createHtmlElement('p', 'text-primary') . "\n"; 
echo createHtmlElement('span', 'highlight') . "\n"; 
echo createHtmlElement('invalidTag', 'error-class') . "\n"; 

?>