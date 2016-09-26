<?php
$link = mysql_connect(_DBSERVER, _DBUSER, _DBPASS);
mysql_select_db(_DBNAME);
//$link = mysql_connect("127.0.0.1:3307", "root", "root");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>