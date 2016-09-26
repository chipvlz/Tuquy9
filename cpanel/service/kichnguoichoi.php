<?php
$name = $_POST["username"];
$note = $_POST["note"];


$sql = "SELECT * FROM player where username='$name'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);

if ($row) {
    $sql = "UPDATE player SET actived = 0 WHERE username='$name'";
    $result = mysql_query($sql);
    
    echo "Kích tài khoản thành công!";die;
}else {
    echo "Tài khoản không tồn tại, vui lòng nhập lại";die;
}



