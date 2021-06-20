<?php
$mainMenu = [
    [
        'title' => 'Главная',
        'path' => '/',
        'sort' => 5
    ],
    [
        'title' => 'О нас',
        'path' => '/route/about.php',
        'sort' => 2,
    ],
    [
        'title' => 'Контакты',
        'path' => '/route/contacts.php',
        'sort' => 4,
    ],
    [
        'title' => 'Новости',
        'path' => '/route/news.php',
        'sort' => 3,
    ],
    [
        'title' => 'Каталог',
        'path' => '/route/catalog.php',
        'sort' => 1,
    ],
];

function arraySort(&$menu, $key = 'sort', $sort = SORT_ASC)
{
    usort($menu, mySort($key, $sort));
}

function mySort($key, $sort): Closure
{
    if ($sort === SORT_ASC) {
        return function ($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        };
    } else if ($sort === SORT_DESC) {
        return function ($a, $b) use ($key) {
            if ($a === $b) return 0;
            return $a < $b ? 1 : -1;
        };
    }

}

function renderMenu($menu, $position = 'header')
{
    $style = $position === 'footer' ? 'bottom' : '';
    $fz = $position === 'footer' ? 'fz12' : 'fz16';
    echo "<ul class='main-menu $style $fz'>";
    foreach ($menu as &$item) {
        if ($item['path'] === $_SERVER['REQUEST_URI']) {
            echo "<li class='selected'><a href = '{$item['path']}'>{$item['title']}</a></li>";
        } else {
            echo "<li><a href = '{$item['path']}'>{$item['title']}</a></li>";
        }
    }
    echo "</ul>";
}

function showMenu($position, &$menu)
{
    if ($position === 'header') {
        arraySort($menu);
        renderMenu($menu);
    } else if ('footer') {
        arraySort($menu, 'title', SORT_DESC);
        renderMenu($menu, $position);
    }
}