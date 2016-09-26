<?php

function execPostRequest($url, $data)
{
    // open connection
    $ch = curl_init($url);

    // set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // execute post
    $result = curl_exec($ch);

    // close connection
    curl_close($ch);
    return $result;
}

$pincode = $_POST["pincode"];
$serial = $_POST["serial"];
$type = $_POST["type"];
$time = time();

$transRef = md5($time); //merchant's transaction reference
$access_key = '4aju4iqtlakoxy4sa6jz'; //require your access key from 1pay
$secret = 'hhfm3myg37uwbsrazn6jijy4p7kzl468'; //require your secret key from 1pay
//$type = $type;
$pin = $pincode;
//$serial = $serial;
$data = "access_key=" . $access_key . "&pin=" . $pin . "&serial=" . $serial . "&transRef=" . $transRef . "&type=" . $type;
$signature = hash_hmac("sha256", $data, $secret);
$data.= "&signature=" . $signature;



//do some thing
$json_cardCharging = execPostRequest('https://api.1pay.vn/card-charging/v5/topup', $data);
$decode_cardCharging = json_decode($json_cardCharging, true);  // decode json


if (isset($decode_cardCharging)) {
    $description = $decode_cardCharging["description"];   // transaction description
    $status = $decode_cardCharging["status"];
    $amount = $decode_cardCharging["amount"];       // card's amount
    $transId = $decode_cardCharging["transId"];
    
    $username = $_SESSION["username"];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // xử lý dữ liệu của merchant
    header("Content-Type: application/json;charset=utf-8");
    
    if ($status == "00") {
        $sqlh = "INSERT INTO addcardhistory (time, vendor, cardid, seri, amount, status, username, ip, description) VALUES (
        '$time','$type','$pincode','$serial','$amount','1', '$username', '$ip', '$description')";
        mysql_query($sqlh);
        
        $sql = "UPDATE player SET realmoney = realmoney + $amount WHERE username='$username'";
        mysql_query($sql);
        
        echo '{"status": "00", "amount": '.$amount.'}';
    }else{
        $sqlh = "INSERT INTO addcardhistory (time, vendor, cardid, seri, amount, status, username, ip, description) VALUES (
        '$time','$type','$pincode','$serial','0','0', '$username', '$ip', '$description')";
        mysql_query($sqlh);
        
        echo $json_cardCharging;//"Nạp thẻ không thành công, vui lòng kiểm tra lại mã thẻ và số serial.";        
    }
}else {
    // run query API's endpoint
    $data_ep = "access_key=" . $access_key . "&pin=" . $pin . "&serial=" . $serial . "&transId=&transRef=" . $transRef . "&type=" . $type;
    $signature_ep = hash_hmac("sha256", $data_ep, $secret);
    $data_ep.= "&signature=" . $signature_ep;
    $query_api_ep = execPostRequest('https://api.1pay.vn/card-charging/v5/query', $data_ep);
    $decode_cardCharging=json_decode($json_cardCharging,true);  // decode json
    $description_ep = $decode_cardCharging["description"];   // transaction description
    $status_ep = $decode_cardCharging["status"];
    $amount_ep = $decode_cardCharging["amount"];       // card's amount
    // Merchant handle SQL
    
    
}
