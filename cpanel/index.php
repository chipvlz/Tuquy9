<?php

session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");

include_once 'class/AltoRouter.php';
include_once 'class/Config.php';
include_once 'class/Connection.php';

$router = new AltoRouter();
$router->setBasePath('');

$router->map('GET','/', 'home.php', 'home');
$router->map('POST','/getservice/[*:service]', 'service.php', 'postservice');
$router->map('GET','/getservice/[*:service]', 'service.php', 'getservice');
$router->map('GET','/getpage/[*:page]', 'home.php', 'getpages');
$router->map('POST','/loadcontent/[*:page]', 'loadcontent.php', 'loadcontent');

$match = $router->match();
//echo $match['params']['service'];die;
if($match) {
    if ((!isset($_SESSION['isadminlogged']) || $_SESSION['isadmin'] == 0) && $match['params']['service'] != "login") {
        require 'login.php';
    }else {
        require $match['target'];
    }
    mysql_close( );
}
else {
    header("HTTP/1.0 404 Not Found");
    require '404.html';
}
?>