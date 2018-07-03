<?php

// 签名结构
class SignParam {
    var $creator = "";
    var $nonce = "";
    var $private_key = "";

    function __construct($creator,$nonce,$private_key){
        $this->creator = $creator;
        $this->nonce = $nonce;
        $private_key = $private_key;
    }

    function getCreator(){
        return $this->creator;
    }

    function getNonce(){
        return $this->nonce;
    }

    function getPrivateKey(){
        return $this->private_key;
    }

    function setCreator($creator){
        $this->creator = $creator;
    }

    function setNonce($nonce){
        $this->nonce = $nonce;
    }

    function setPrivateKey($private_key){
        $this->private_key = $private_key;
    }
}

//class 

class RegisterWalletBody {
    var $type = "";
    var $access = "";
    var $phone = "";
    var $email = "";
    var $secret = "";

    function __construct($type,$access,$secret,$phone = "",$email = ""){
        $this->type = $type;
        $this->access = $access;
        $this->phone = $phone;
        $this->email = $email;
        $this->secret = $secret;
    }

    function getType(){
        return $this->type;
    }

    function getAccess(){
        return $this->access;
    } 

    function getPhone(){
        return $this->phone;
    }

    function getEmail(){
        return $this->email;
    }

    function getSecret(){
        return $this->secret;
    }
}

class POEBody {
    var $name = "";
    var $parent_id = "";
    var $owner = "";
    var $hash = "";
    var $metadata = "";

    function __construct($name,$owner,$parent_id = "",$hash = "",$metadata = ""){
        $this->name = $name;
        $this->owner = $owner;
        $this->parent_id = $parent_id;
        $this->hash = $hash;
        $this->metadata = $metadata;
    }

    function getName(){
        return $this->name;
    }

    function getOwner(){
        return $this->owner;
    }
}

class IssueCTokenBody {
    var $issuer = "";
    var $owner = "";
    var $asset_id = "";
    var $amount = "";

    function __construct($issuer,$owner,$asset_id,$amount){
        $this->issuer = $issuer;
        $this->owner = $owner;
        $this->asset_id = $asset_id;
        $this->amount = $amount;
    }

    function getIssuer(){
        return $this->issuer;
    }

    function getOwner(){
        return $this->owner;
    }

    function getAssetId(){
        return $this->asset_id;
    }

    function getAmount(){
        return $this->amount;
    }
}

class IssueAssetBody {
    var $issuer = "";
    var $owner = "";
    var $asset_id = "";

    function __construct($issuer,$owner,$asset_id){
        $this->issuer = $issuer;
        $this->owner = $owner;
        $this->asset_id = $asset_id;
    }

    function getIssuer(){
        return $this->issuer;
    }

    function getOwner(){
        return $this->owner;
    }

    function getAssetId(){
        return $this->asset_id;
    }
}

class TransferCTokenBody {
    var $from = "";
    var $to = "";
    var $tokens = array();

    function __construct($from,$to,$tokens){
        $this->from = $from;
        $this->to = $to;
        $this->tokens = $tokens;
    }

    function getFrom(){
        return $this->from;
    }

    function getTo(){
        return $this->to;
    }

    function getTokens(){
        return $this->tokens;
    }
}

class TransferAssetBody {
    var $from = "";
    var $to = "";
    var $assets= array();

    function __construct($from,$to,$assets){
        $this->from = $from;
        $this->to = $to;
        $this->assets = $assets;
    }

    function getFrom(){
        return $this->from;
    }

    function getTo(){
        return $this->to;
    }

    function getAssets(){
        return $this->assets;
    }
}

class TokenAmount {
    var $token_id = "";
    var $amount = 0;

    function __construct($token_id,$amount){
        $this->token_id = $token_id;
        $this->amount = $amount;
    }
}
