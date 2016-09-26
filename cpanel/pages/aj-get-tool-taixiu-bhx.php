<?php 

if ($_POST['thoigian'] == 1) {
    $d = date("d");
    $m = date("m");
    $y = date("Y");
    
    $ft = strtotime($y."-".$m."-".$d." 00:00:00");
    $tt = strtotime($y."-".$m."-".$d." 23:59:59");
    
}else if ($_POST['thoigian'] == 2) {
    $ft = strtotime('monday this week');
    $tt = strtotime('next monday');
}else{
    $from = strtotime('first day of this month');
    $to = strtotime('last day of this month');
    
    $fromdate = date("Y-m-d",$from);
    $todate = date("Y-m-d",$to);
    
    $f = explode ("-", $fromdate);
    $t = explode ("-", $todate);
    
    $ft = strtotime($f[0]."-".$f[1]."-".$f[2]);
    $tt = strtotime($t[0]."-".$t[1]."-".$t[2]);
}

$sqlthang = "select max(dem) as demvan, tien, username from 
(SELECT count(*) as dem, sum(tien_thuong) as tien, username
from bonushistory 
WHERE LOWER(gameid) LIKE '%taixiu%' AND time >= $ft AND time <= $tt
AND (tien_thuong + tien_tra_lai) >= tien_cuoc AND tien_thuong > 0
group by username) x";

$sqlthua = "select max(dem) as demvan, tien, username from
(SELECT count(*) as dem, sum(tien_thuong) as tien, username
from bonushistory
WHERE LOWER(gameid) LIKE '%taixiu%' AND time >= $ft AND time <= $tt
AND tien_thuong = 0
group by username) x";

$rsthang = mysql_query($sqlthang);
$rsthua = mysql_query($sqlthua);

$thang = mysql_fetch_array($rsthang, MYSQL_ASSOC);
$thua = mysql_fetch_array($rsthua, MYSQL_ASSOC);

//echo date("Y-m-d H:i:s --",$ft); 
//echo date("Y-m-d H:i:s --",$tt); 
//print_r($sqlthua);
?>
<div style="padding: 20px;">
    <h5>Thắng nhiều nhất: <?php echo $thang['username']?> - <?php echo $thang['demvan']?> ván.</h5>
    <p></p>
    <h5>Thua nhiều nhất: <?php echo $thua['username']?> - <?php echo $thua['demvan']?> ván.</h5>

</div>