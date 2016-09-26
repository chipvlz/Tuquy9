<?php 
session_start();
include_once 'class/AltoRouter.php';
include_once 'class/Session.php';
include_once 'class/Config.php';
include_once 'class/Connection.php';
include_once 'class/CreateToken.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');

$router = new AltoRouter();
$router->setBasePath('');

$router->map('GET','/', 'home.php', 'home');
$router->map('POST','/header', 'header.php', 'header');
$router->map('GET','/getcaptchar', 'captchar.php', 'getcaptchar');
$router->map('GET','/getcaptchar/[*:random]', 'captchar.php', 'getcaptcharurl');
$router->map('POST','/getpopup/[*:popup]/[*:random]', 'popup.php', 'getpopup');
$router->map('POST','/getservice/[*:service]', 'service.php', 'getservice');
$router->map('POST','/opengame/[*:gameid]', 'opengame.php', 'opengame');
$router->map('GET','/getgame/[*:gameid]', 'opengame.php', 'getgame');

/* Match the current request */
$match = $router->match();
if($match) {
    include_once $match['target'];
    mysql_close( );
}
else {
    header("HTTP/1.0 404 Not Found");
    require '404.html';
}
?>