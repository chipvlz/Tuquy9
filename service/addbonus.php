<?php
$jstring = $_POST["jstring"];

$auser = json_decode($jstring);
$areturn = array();

foreach ($auser as $u) {    
    
    $userId = $u->userId;
    $tien_cuoc = $u->tien_cuoc;
    $tien_thuong = $u->tien_thuong;
    $tien_tra_lai = $u->tien_tra_lai;
    $loai = $u->loai;       
	$gameid = $u->gameid; 
    
    $userId = tokenDecode($userId);
    
    $sql = "UPDATE player SET $loai = $loai + ".($tien_thuong+$tien_tra_lai)." WHERE username='$userId'";
    $result = mysql_query($sql);
    
    //print_r(mysql_affected_rows());
    
    if (mysql_affected_rows() > 0) {
        $u->trang_thai = 1;
        
        //history
        $sqlh = "INSERT INTO bonushistory (username, tien_cuoc, tien_thuong, tien_tra_lai, loai, gameid, time, note) VALUES (
        '$userId',$tien_cuoc,$tien_thuong,$tien_tra_lai,'$loai','$gameid', ".time().", '')";
        mysql_query($sqlh);
        
    }else {
        $u->trang_thai = 0;
    }
    
    $areturn[] = $u;    
}

print json_encode($areturn);