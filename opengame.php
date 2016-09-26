<?php 
if ($_SESSION["islogin"]) { 
    $gameid = $match['params']['gameid'];
    //print_r($match);die;
   //echo $match["name"];die;
//     if ($match["name"] == "opengame" && $gameid == "sver3caychuong") {
//         echo $gameid;die;
//     }else{
        require_once $gameid.'/layout.php';
//     }
}else{
    echo "NOTLOGIN";
    die;
} 