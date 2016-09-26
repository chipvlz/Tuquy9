<?php

function tokenEncode($str) {
    return  base64_encode(base64_encode($str."_".date("YmdHis")).md5(time()));
}

function tokenDecode($str) {
    return substr(base64_decode(substr(base64_decode($str), 0, -32)), 0, -15);
}

