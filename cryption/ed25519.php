<?php

require dirname(__FILE__).'/../vendor/autoload.php';

function get_keypair(){
    return sodium_crypto_sign_keypair();
}

function get_publickey($keypair){
    return sodium_crypto_sign_publickey($keypair);
}

function get_secretkey($keypair){
    return sodium_crypto_sign_secretkey($keypair);
}

function sign($message, $secretkey){
    return sodium_crypto_sign_detached($message, $secretkey);
}

function verify($signature, $message,$publickey){
    return sodium_crypto_sign_verify_detached($signature, $message, $publickey);
}

