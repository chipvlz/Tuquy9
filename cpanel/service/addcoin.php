<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
$name = $_POST["username"];


$sql = "SELECT * FROM player where username='$name'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);

if ($row) {
    $loaitien = $_POST["typemoney"];
    $sotien = $_POST["numsValid"];
    $hanhdong = $_POST["actiontype"];
    $note = $_POST["note"];
    $moder = $_SESSION['adminuser'];
    $time = time();
    
    $math = "";
    if ($hanhdong == 1 || $hanhdong == 3) { //+, vay
        $math = "+";
        $sql = "UPDATE player SET $loaitien = $loaitien + ".$sotien." WHERE username='$name'";       

    }else if ($hanhdong == 2 || $hanhdong == 4)  {//-, tra
        $math = "-";
        $sql = "UPDATE player SET $loaitien = $loaitien - ".$sotien." WHERE username='$name'";
        
    }
    
    
    
    $s = "INSERT INTO addmoneyhistory (username, type, value, action, note, moder, time) VALUES (
        '$name', '$loaitien', '$sotien', '$hanhdong', '$note', '$moder', $time )";    
    //echo $s;die;
    $result = mysql_query($sql);
    $result = mysql_query($s);
    
    if ($loaitien == 'realmoney') {
        $sss = "SELECT * FROM player where username='$name'";
        $rsss = mysql_query($sss);
        $rowsss = mysql_fetch_array($rsss,MYSQL_ASSOC);
    
        $description = "$math$sotien = ".$rowsss['realmoney']." ".$note;
    
        $ss = "INSERT INTO addgemhistory (username, description, moder, time) VALUES (
        '$name', '$description', '$moder', $time)";
    
        $result = mysql_query($ss);
    }
    
    echo "Thành công!";die;
    
}else {
    echo "Tài khoản không tồn tại, vui lòng nhập lại";die;
}