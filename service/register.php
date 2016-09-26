<?php
$name = $_POST['name'];
$pass = md5($_POST['pass']);
$captchar = $_POST['captchar'];

if ($_SESSION["captchar"] != $captchar) {    
    print "Mã xác nhận không chính xác, vui lòng thử lại.";
    die;
}else{
    $name = str_replace("'", "", str_replace('"', '', $name));
    $sql = "SELECT * FROM player WHERE LOWER(username)='".strtolower ($name)."'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs,MYSQL_ASSOC);
    
    if ($row) {
        print "Tài khoản này đã tồn tại, vui lòng thử lại.";
        die;
    }
    $createDate = date ("Y-m-d H:i:s", time()); 
    $sql = "INSERT INTO player (username, password, createdate, virtualmoney, realmoney, actived) VALUES (
        '$name',
        '$pass',
        '$createDate',
        500000,
        0,
        1
        )";
    
    $result = mysql_query($sql);
    if (!$result) {
        print "Lỗi không thể đăng ký tài khoản.";
        die;
    }
    $_SESSION["username"] = $name;
    $_SESSION['fullname'] = $name;
    $_SESSION['character'] = $name;
    $_SESSION['avatar'] = "";
    $_SESSION["islogin"] = true;
    print "TRUE";
}
die;