<?php
require 'vendor/autoload.php';
error_log( '/tmp/php.log');
$router = new AltoRouter();
$router->map('GET', '/', function(){
    require 'home.php';
}, 'index');
$router->map('GET', '/[a:lan]/', function($lan){
    require 'home.php';
});
$router->map('GET', '/[a:lan]', function($lan){
    require 'home.php';
});
$match = $router->match();
if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	require 'err404.html';
}
?>