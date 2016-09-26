<?php
$gameid = $_POST["gameid"];
$name = $_POST["name"];
$url = $_POST["url"];


$original_file_name = $_FILES["logo"]["name"];

if ($original_file_name != '') {

    $file_extension = substr($original_file_name, strlen($original_file_name)-3, strlen($original_file_name));
    $new_file_name = $gameid.'_logo.'.$file_extension;
    $avatar = "images/logogame/".$new_file_name;

    move_uploaded_file($_FILES["logo"]["tmp_name"],$avatar);

    $ulogo = ",logo='$avatar'";
}

$sql = "UPDATE gamelist SET name='$name', url='$url' $ulogo WHERE id=$gameid";

$result = mysql_query($sql);

header('Location: /getpage/qt-game-list');