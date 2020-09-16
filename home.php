<?php
require __DIR__ . '/header.php';
require './cockpit/bootstrap.php';
switch ($lan) {
    case 'en':
        $lan = "";
        break;
    case 'ru':
        $lan = '_ru';
        break;
    case 'lv':
    default:
        $lan = '_lv';
        break;
}
$background = cockpit('singletons')->getData('background');
$navigation = cockpit('collections')->find('navigation');
$content = cockpit('collections')->find('content');
//$products = cockpit('collections')->find('products');
$contacts = cockpit('collections')->find('contacts');
$form_translation = cockpit('collections')->find('leave_message');
$gallery = cockpit('singletons')->getData('gallery');

/*usort($products, function ($i1, $i2) {
    return $i1['_o'] <=> $i2["_o"];
});*/

if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]) != $mobile || $_GET["m"]) {
    //require 'mobile-home.php';
    require 'desktop-home.php';
} else {
    require 'desktop-home.php';
}

$development = false;
