<?php

require_once (__DIR__ . "/../log/log.php");
require_once (__DIR__ . "/../error/error.php");

// ed25519签名
class Signature{

    function sign($body,$signature_param,&$data){
        if(empty($body)){
            //$message = "invalid params";
            //ErrLogChain(__FILE__,__LINE__,$message);
            return errCode["InvalidParamsErrCode"];
        }

        if(empty($signature_param)){
            return errCode["InvalidParamsErrCode"];
        }

        $key = $signature_param["key"];
        $did = $signature_param["did"];
        $nonce = $signature_param["nonce"];
        
        // 1.对body进行json编码
        $json_str = json_encode($body);
        if ($json_str == ""){
           // $message = "json encode error";
           // ErrLogChain(__FILE__,__LINE__,$message);
            return errCode["SerializeDataFail"];
        }

        $sign_body = array();
        $sign_body["creator"] = $did;
        $sign_body["nonce"] = $nonce;
        
        // 2.进行base64编码
        $base64_str = base64_encode($json_str);
        if ($base64_str == ""){
            //$message =  "base64 encode error";
            //ErrLogChain(__FILE__,__LINE__,$message);
            return errCode["SerializeDataFail"];
        }

        // 3.签名
        $bin = __DIR__ . "/utils/bin/sign-util";
        $cmd = $bin . " -key " . $key . " -nonce " . $nonce . " -did " . $did . " -data " .$base64_str;
        // 执行签名操作
        exec($cmd,$out);
        if (empty($out)){
            //$message = "sign data error";
            //ErrLogChain(__FILE__,__LINE__,$message);
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

    function signTx($old_script,$signature_param,&$new_script){
        $old_json_str = base64_decode($old_script);
        //解开script拿到公钥
        $old_data = json_decode($old_json_str,true);

        //echo "old data:\n";
        //var_dump($old_data);
        //echo "\n";
        
        if(empty($old_data)){
            $new_script = "";
            return errCode["DeserializeDataFail"];
        }
        
        if($old_data["publicKey"] == ""){
            $new_script = "";
            return errCode["DeserializeDataFail"];
        }

        $key = $signature_param["key"];
        $did = $signature_param["did"];
        $nonce = $signature_param["nonce"];

        // 3.签名
        $bin = __DIR__ . "/utils/bin/sign-util";
        $cmd = $bin . " -key " . $key . " -nonce " . $nonce . " -did " . $did . " -data " .$old_data["publicKey"];

        exec($cmd,$out);
        if (empty($out)){
            return errCode["ED25519SignFail"];
        }
        ///echo "ed25519 : ",$out[0],"\n";
        $new_data = array(
            "creator" => $signature_param["did"],
            "nonce" => $signature_param["nonce"],
            "publicKey" => $old_data["publicKey"],
            "signature" => $out[0],
        );

        $new_json_str = json_encode($new_data);
        //echo "new json str:",$new_json_str,"\n";
        $new_script = base64_encode($new_json_str);

       // echo "new script:",$new_script,"\n";

        if($new_script == ""){
            return errCode["ED25519SignFail"];
        }
        return 0;
    }
}
