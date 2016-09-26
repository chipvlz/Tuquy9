<?php
$email = $_POST['email'];
$name  = $_SESSION["username"];

if ($_SESSION["islogin"]) {
    
    $sql = "SELECT * FROM player WHERE LOWER(username)='".strtolower ($name)."'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs,MYSQL_ASSOC);
    
    if (!$row) {
        print "Tài khoản này không tồn tại, vui lòng đăng nhập lại.";
        die;
    }
    
    $email = str_replace("'", "", str_replace('"', '', $email));
    
    $sql = "SELECT * FROM player WHERE LOWER(email)='".strtolower ($email)."'";
    
    if ($row) {
        print "Email này đã được sử dụng, vui lòng kiểm tra lại.";
        die;
    }
    
    $sql = "UPDATE player SET email='".$email."' WHERE LOWER(username)='".strtolower ($name)."'";
    
    $result = mysql_query($sql);
    
    print "TRUE";
    die;
    
}else{
    print "Bạn chưa đăng nhập hoặc đã hết thời gian online, vui lòng đăng nhập lại.";
    die;
}