<?php
if (!isset($_SESSION['islogin'])) {
    $_SESSION["username"] = "";
    $_SESSION['fullname'] = "";
    $_SESSION['character'] = "";
    $_SESSION['avatar'] = "";
    $_SESSION["islogin"] = false;
}