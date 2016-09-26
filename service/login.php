<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$name = $_POST['name'];
$pass = md5($_POST['pass']);

$sql = "SELECT * FROM player where username='$name' AND password = '$pass'";
//echo $sql;die;
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);

$_SESSION["username"] = "";
$_SESSION['fullname'] = "";
$_SESSION['character'] = "";
$_SESSION['avatar'] = "";
$_SESSION["virtualmoney"] = 0;
$_SESSION['realmoney'] = 0;
$_SESSION["islogin"] = false;

if ($row){
    //print_r($row);die;
    if ($row["actived"]) {
        $_SESSION["username"] = $row["username"];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['character'] = $row['character'];
        $_SESSION['avatar'] = $row['avatar'];
        $_SESSION["virtualmoney"] = $row["virtualmoney"];
        $_SESSION['realmoney'] = $row['realmoney'];
        $_SESSION["islogin"] = true;
        
        $sql = "INSERT INTO loginhistory (username, logintime) VALUES ( '$name', '".date ("Y-m-d H:i:s", time())."')";
        $result = mysql_query($sql);
        
        if ($row["email"] == "") {
            print "NOTEMAIL";
            die;
        }
        print "TRUE";
    }else{
        print "Tài khoản đang bị khóa, hoặc chưa kích hoạt.";
    }
}
else
{
    print "Tên đăng nhập hoặc mật khẩu không đúng.";
}
die;
// while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
//     printf("ID: %s  Name: %s", $row["id"], $row["name"]);
// }

// //print_r($_POST['name']);die;