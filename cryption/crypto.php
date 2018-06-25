<?php

require (__DIR__ . "/../config.php");


// ecc 签名加密
class encrypt{
    var $api_key;
    var $path;
    var $mode1 = 1; // 加密与签名
    var $mode2 = 2; // 验签与解密

    function __construct($path,$api_key){
        $this->api_key = $api_key;
        $this->path = $path;
    }

    function signAndEncrypt($data,&$cipher_text){
        //1.进行json编码
        $json_str = json_encode($data);
        if ($json_str == ""){
            $cipher_text = "";
            
            // 写日志
            $error_message = __FILE__ . __LINE__ . "json encode error";
            error_log($error_message,$log_mode,$log_path);
            return -1;
        }

        //2.base64编码
        $base64_str = base64_encode($json_str);
        if ($base64_str == ""){
            $cipher_text = "";

            $error_message = __FILE__ . __LINE__ . "base64 encode error";
            error_log($error_message,$log_mode,$log_path);
            return -1;
        }

        // 拼装加密命令
        $bin = __DIR__ . "/utils/bin/crypto-util";
        $cmd = $bin . " -apikey " .  $this->api_key . " -data " . $base64_str. " -path " . $this->path . " -mode " . $this->mode1;

        //3.加密签名
        exec($cmd,$out);
        if (empty($out)){
            $cipher_text = "";

            $error_message = __FILE__ . __LINE__ . "sign and encrypt error";
            error_log($error_message,$log_mode,$log_path);
            return -1;
        }
        $cipher_text = $out[0];
        return 0;
    }

    function decryptAndVerify($cipher_text,&$data){
        // 拼装解密命令
        $bin = __DIR__ . "/utils/bin/crypto-util";
        $cmd = $bin . " -apikey " .  $this->api_key . " -data " . $cipher_text. " -path " . $this->path . " -mode " . $this->mode2;

        //1.验签与解密
        exec($cmd,$out);
        if (empty($out)){
            $error_message = __FILE__ . __LINE__ . "decrypt and verify error";
            error_log($error_message,$log_mode,$log_path);
            return -1;
        }

        //2.json解码
        $data = json_decode($out[0],true);
        if (empty($data)){
            $error_message = __FILE__ . __LINE__ . "json decode error";
            error_log($error_message,$log_mode,$log_path);
            return -1;
        }

        if ($data["ErrCode"] == 0) {
            if($data["Payload"]!=""){
                $data["Payload"] = json_decode($data["Payload"],true);
            }
        }

        return 0;
    } 
}

