<?php
require __DIR__ . '/header.php';
require './cockpit/bootstrap.php';
if (!isset($lan)) {
    preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]), $matches); // Получаем массив $matches с соответствиями
    $langs = array_combine($matches[1], $matches[2]); // Создаём массив с ключами $matches[1] и значениями -$matches[2]
    foreach ($langs as $n => $v) {
        $langs[$n] = $v ? $v : 1; // Если нет q, то ставим значение 1
    };
    arsort($langs); // Сортируем по убыванию q
    $defaultLang = key($langs); // Берём 1-й ключ первого (текущего) элемента (он же максимальный по q)
    $cutDefaultLang = substr($defaultLang, 0, 2);
    $available_langs = ['lv', 'ru', 'en'];
    foreach ($langs as $l => $prior) {
        $key = array_search(substr($l, 0, 2), $available_langs);
        if ($key != False) {
            $lan = $available_langs[$key];
            break;
        }
    };
};
switch ($lan) {
    case 'lv':
        $lan = "_lv";
        break;
    case 'ru':
        $lan = '_ru';
        break;
    case 'en':
    default:
        $lan = '';
        break;
}
$background = cockpit('singletons')->getData('background');
$navigation = cockpit('collections')->find('navigation');
$content = cockpit('collections')->find('content');
$products = cockpit('collections')->find('products');
$contacts = cockpit('collections')->find('contacts');
$form_translation = cockpit('collections')->find('leave_message');
$gallery = cockpit('singletons')->getData('gallery');

foreach ($gallery["image"] as &$value) {
    $value["path"] = "." . $value["path"];
}

usort($products, function ($i1, $i2) {
    return $i1['_o'] <=> $i2["_o"];
});

if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]) != $mobile || $_GET["m"]) {
    require 'mobile-home.php';
} else {
    require 'desktop-home.php';
}

$development = false;
