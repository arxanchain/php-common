<?php

/*
$path = "/etc/arxanchin/key/client_certs";
$api_key = "eZUDImzTp1528874024";
$mode1 = 1;
 */

$cmd1 = "crypto-util" . " -apikey " .  $api_key . " -data " . $base64_str. " -path " . $path . " -mode " . $mode1 ;



class encrypt{
    $api_key;
    $path;
    $mode1 = 1; // 加密与签名
    $mode2 = 2; // 验签与解密

    function sign_and_encrypt($data){
        // 拼装加密命令
        $cmd = "crypto-util" . " -apikey " .  $api_key . " -data " . $base64_str. " -path " . $path . " -mode " . $mode1 ;

        //1.进行json编码
        json_encode($data)
        //2.base64编码
        base64_encode()
        //3.加密签名
    }

    function decrypt_and_verify($data){
        //1.验签与解密
        //2.json解码
        // 拼装解密命令
        $cmd = "crypto-util" . " -apikey " .  $api_key . " -data " . $base64_str. " -path " . $path . " -mode " . $mode2 ;
    } 
}
