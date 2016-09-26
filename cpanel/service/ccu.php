<?php 
$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = $f[2]."-".$f[0]."-".$f[1];
$tt = $t[2]."-".$t[0]."-".$t[1];

$f1 = strtotime($ft);
$f2 = strtotime($tt);
$datediff = $f2 - $f1;
$days = floor($datediff/(60*60*24)) + 1;

$sqldk = "select DATE(createdate) ngay, count(*) as dem from `player` where date(createdate) >= '$ft' and date(createdate)<= '$tt'
group by DATE(createdate) ORDER BY createdate";

$maxy = 0;
$dangky = array();
$rs = mysql_query($sqldk);
while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {     
    $dangky[$row["ngay"]] = $row["dem"];
    $maxy = max($maxy, $row["dem"]);
}

$sqldn = "select DATE(logintime) ngay, count(*) as dem from `loginhistory` where date(logintime) >= '$ft' and date(logintime)<= '$tt'
group by DATE(logintime)";

$dangkn = array();
$rs = mysql_query($sqldn);
while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
    $dangkn[$row["ngay"]] = $row["dem"];
    $maxy = max($maxy, $row["dem"]);
}

$perdk = array();
$perdn = array();
for ($i = 0; $i< $days; $i++) {
    $date = date('Y-m-d',strtotime($ft.' +'.$i.' days'));
    $perdk[] = $dangky[$date];
    $perdn[] = $dangkn[$date];
}




$json = array();
$json["maxy"] = $maxy;
$json["countdays"] = $days;
$json["listdangky"] = $perdk;
$json["listdangnhap"] = $perdn;

echo json_encode($json);
die;



?>