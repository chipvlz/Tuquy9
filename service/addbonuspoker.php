<?php
$jstring = $_POST["jstring"];

$auser = json_decode($jstring);
$areturn = array();

foreach ($auser as $u) {    
    
    $userId = $u->userId;
    $tien_cuoc = $u->tien_cuoc;
    $tien_thuong = $u->tien_thuong;
    $loai = $u->loai;       
	$ket_qua = $u->ket_qua;
    
    $userId = tokenDecode($userId);
    
	if ($ket_qua == 'thang') {
		$sql = "UPDATE player SET $loai = $loai + ".($tien_thuong+$tien_tra_lai)." WHERE username='$userId'";
		$result = mysql_query($sql);		
    }

	$u->trang_thai = 1;
	
	//history
	$sqlh = "INSERT INTO bonushistory (username, tien_cuoc, tien_thuong, tien_tra_lai, loai, gameid, time, note) VALUES (
	'$userId',$tien_cuoc,$tien_thuong,0,'$loai','minipoker', ".time().", '')";
	mysql_query($sqlh);
    
    $areturn[] = $u;    
}

print json_encode($areturn);