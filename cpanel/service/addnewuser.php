<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
$name = $_POST["username"];
$email = $_POST["email"];

$sql = "SELECT * FROM player where username='$name'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);

if ($row) {
    echo "Tài khoản đã tồn tại, vui lòng chọn tên khác";die;
}else {
    $sql = "SELECT * FROM player where email='$email'";
    $s = mysql_query($sql);
    $r = mysql_fetch_array($s,MYSQL_ASSOC);
    
    if ($r) {
        
        echo "Email đã tồn tại, vui lòng chọn email khác";die;
        
    } else if ($_POST["addnewuser"] != '') {
        $fullname = $_POST["fullname"];        
        $password = md5($_POST["password"]);
        $phone = $_POST["phone"];
        $virtualmoney = $_POST["virtualmoney"];
        $realmoney = $_POST["realmoney"];
        $isadmin = $_POST["isadmin"];
        
        $original_file_name = $_FILES["avatar"]["name"];
        if ($original_file_name != '') {
        
            $file_extension = substr($original_file_name, strlen($original_file_name)-3, strlen($original_file_name));
            $new_file_name = $name.'_avatar.'.$file_extension;
            $avatar = "/avatar/".$new_file_name;
        
            move_uploaded_file($_FILES["avatar"]["tmp_name"],"..".$avatar);
        
        }
        $createDate = date ("Y-m-d H:i:s", time());
        $sql = "INSERT INTO player (username, fullname, password, email, phone, createdate, virtualmoney, realmoney, actived, isadmin) VALUES (
        '$name',
        '$fullname',
        '$password',
        '$email',
        '$phone',
        '$createDate',
        $virtualmoney,
        $realmoney,
        1,
        $isadmin
        )";
        
        $result = mysql_query($sql);
        
        header('Location: /getpage/qt-user-list');
    }
}