<?php

if ($_SESSION["islogin"]) {
    
    $name = $_SESSION["username"];
    
    $sql = "SELECT * FROM player where username='$name'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    
    if ($row['actived'] == 0) 
    {
        $_SESSION["username"] = "";
        $_SESSION['fullname'] = "";
        $_SESSION['character'] = "";
        $_SESSION['avatar'] = "";
        $_SESSION["virtualmoney"] = 0;
        $_SESSION['realmoney'] = 0;
        $_SESSION["islogin"] = false;
        
        echo "NOTACTIVED";
        die;
    }else{
        $bala = array();
        
        $bala["real"] = number_format($row['realmoney']);
        $bala["virtual"] = number_format($row["virtualmoney"]);
        
        echo json_encode($bala);
    }
}else{
    echo "NOTLOGIN";
}