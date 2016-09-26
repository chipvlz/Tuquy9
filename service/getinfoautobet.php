<?php
$gameid = $_POST['gameid'];
$gate = $_POST['gate'];

$sql = "SELECT * FROM taixiu_autobet LIMIT 1";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs, MYSQL_ASSOC);

$areturn = array();

if ($row['actived']) { 
    $areturn['actived'] = 1;
    $areturn['tokenid'] = tokenEncode($row['username']);
    $areturn['betmoney'] = $row['betmoney'];    
    
    $sqlh = "INSERT INTO bethistory (username, gameid, betmoney, bettype, remainmoney, time, status, gate) VALUES (
    '".$row['username']."','$gameid',".$row['betmoney'].",'realmoney','-1',".time().", 1, $gate)";
    mysql_query($sqlh);
    
}else{
    $areturn['actived'] = 0;
}

print json_encode($areturn);