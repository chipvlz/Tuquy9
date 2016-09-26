<?php
$username = $_POST["username"];
$bettype = $_POST["bettype"];
$betmoney = $_POST["betmoney"];
$actived = $_POST["actived"];

$sql = "UPDATE taixiu_autobet SET username='$username', bettype='$bettype', betmoney='$betmoney', actived='$actived'";



$result = mysql_query($sql);

echo "Lưu thành công!";