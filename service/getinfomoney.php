<?php 
//include_once '../class/Config.php';
//include_once '../class/Connection.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');

$name = $_POST['uid'];
$bettype = $_POST['bettype'];

$name = tokenDecode($name);



$mt = explode(' ', microtime());
$milliseconds = $mt[0]*1000000;

$res = array();
$res['uid'] = $name;
$res['bettype'] = $_POST['bettype'];
$res['status'] = 0;
$res['time'] = date("YmdHis").$milliseconds;
$res['name'] = "";
$res['email'] = "";
$res['remainmoney'] = 0;


    $sql = "SELECT * FROM player where username='$name'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);        
 
    if ($row) {
		$res['status'] = 1;
        $res['name'] = $row['fullname'];
		$res['email'] = $row['email'];
		$res['remainmoney'] = $row[$res['bettype']];
    }

print json_encode($res);

