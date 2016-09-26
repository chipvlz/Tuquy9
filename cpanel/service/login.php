<?php
$name = $_POST['name'];
$pass = md5($_POST['pass']);

$sql = "SELECT * FROM player where username='$name' AND password = '$pass' AND isadmin=1";
//echo $sql;die;
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);

$_SESSION["adminuser"] = "";
$_SESSION["isadmin"] = 0;
$_SESSION["isadminlogged"] = false;

if ($row) {
    //print_r($row);die;
    if ($row["actived"]) {
        $_SESSION["adminuser"] = $row["username"];        
        $_SESSION['isadmin'] = $row['isadmin'];
        $_SESSION["isadminlogged"] = true;

        print "TRUE";
    }else{
        print "Tài khoản đang bị khóa, hoặc không có quyền quản trị viên.";
    }
}
else
{
    print "Tên đăng nhập hoặc mật khẩu không đúng.";
}