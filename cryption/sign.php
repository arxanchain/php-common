<?php

require_once (__DIR__ . "/../log/log.php");
require_once (__DIR__ . "/../error/error.php");

// ed25519签名
class Signature{
    var $did;   // 用户wallet did
    var $key;   // 注册wallet用户，返回的私钥
    var $nonce; // 随机数
    
    function __construct($sign_body){
        $this->did = $sign_body["did"];
        $this->key = $sign_body["key"];
        $this->nonce = $sign_body["nonce"]; 
    }

    function sign($body,&$data){
        // 1.对body进行json编码
        $json_str = json_encode($body);
        if ($json_str == ""){
            $message = "json encode error";
            $error_message = " [" . basename(__FILE__) . "]" .  "[" . __LINE__ . "]: " . $message;
            ErrLogChain($error_message);
            return errCode["SerializeDataFail"];
        }

        $sign_body = array();
        $sign_body["creator"] = $this->did;
        $sign_body["nonce"] = $this->nonce;

        // 2.进行base64编码
        $base64_str = base64_encode($json_str);
        if ($base64_str == ""){
            $message =  "base64 encode error";
            $error_message = " [" . basename(__FILE__) . "]" .  "[" . __LINE__ . "]: " . $message;
            ErrLogChain($error_message);
            return errCode["SerializeDataFail"];
        }

        // 3.签名
        $bin = __DIR__ . "/utils/bin/sign-util";
        $cmd = $bin . " -key " . $this->key . " -nonce " . $this->nonce . " -did " . $this->did . " -data " .$base64_str;
        // 执行签名操作
        exec($cmd,$out);
        if (empty($out)){
            $message = "sign data error";
            $error_message = " [" . basename(__FILE__) . "]" .  "[" . __LINE__ . "]: " . $message;
            ErrLogChain($error_message);
            return errCode["ED25519SignFail"];
        }

        // 4.组装结构
        $sign_body["signature_value"] = $out[0];

        $data["payload"] = $json_str;
        $data["signature"] = $sign_body;

        return 0;
    }

    function __destruct(){
        $this->did = "";
        $this->key = "";
        $this->nonce = "";
    }
}
