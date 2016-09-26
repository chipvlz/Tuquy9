<?php

if ($_SESSION["islogin"]) { 
    
    echo tokenEncode($_SESSION["username"]);
    die;
    
}else {
    echo "NOTLOGIN";
    die;
}
