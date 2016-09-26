<?php

$userid = $_POST["username"];
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$password = $_POST["password"] != "" ? ", password='" . md5($_POST["password"]) . "'" : "";
$phone = $_POST["phone"];
$actived = $_POST["actived"];
$virtualmoney = $_POST["virtualmoney"];
$realmoney = $_POST["realmoney"];
$isadmin = $_POST['isadmin'];

if($_FILES["avatar"]["name"] != ""){
    echo 1;die;
    move_uploaded_file($_FILES["avatar"]["tmp_name"],"thunghiemabc.jpg");
}

$sql = "UPDATE player SET isadmin=$isadmin, virtualmoney=$virtualmoney, realmoney=$realmoney, actived=$actived, phone='$phone', email='$email', fullname='$fullname' $password WHERE username='$userid'";

$result = mysql_query($sql);

echo "Cập nhật thành công!";die;