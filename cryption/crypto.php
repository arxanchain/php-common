<?php

class encrypt{
    var $api_key;
    var $path;
    var $mode1 = 1; // 加密与签名
    var $mode2 = 2; // 验签与解密

    function __construct($path,$api_key){
        $this->api_key = $api_key;
        $this->path = $path;
    }

    function sign_and_encrypt($data,&$cipher_text){
        //1.进行json编码
        $json_str = json_encode($data);
        if ($json_str == ""){
            $cipher_text = "";
            return -1;
        }

        //2.base64编码
        $base64_str = base64_encode($json_str);
        if ($base64_str == ""){
            $cipher_text = "";
            return -1;
        }

        // 拼装加密命令
        $cmd = "crypto-util" . " -apikey " .  $this->api_key . " -data " . $base64_str. " -path " . $this->path . " -mode " . $this->mode1;

        //3.加密签名
        exec($cmd,$out);
        if (empty($out)){
            $cipher_text = "";
            return -1;
        }
        $cipher_text = $out[0];
        return 0;
    }

    function decrypt_and_verify($cipher_text,&$data){
        // 拼装解密命令
        $cmd = "./utils/bin/crypto-util" . " -apikey " .  $api_key . " -data " . $cipher_text. " -path " . $path . " -mode " . $mode2;

        //1.验签与解密
        exec($cmd,$out);

        //2.json解码
        $data = json_decode($out[0],true);
        if (empty($data)){
            return -1;
        }

        return 0;
    } 
}
