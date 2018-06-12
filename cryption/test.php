<?php

require dirname(__FILE__).'/ed25519.php';

$keypair = get_keypair();
$publickey = get_publickey($keypair);
$secretkey = get_secretkey($keypair);

$message = 'This is a test message.';
$wmessage = 'This is a test message for wrong.';
$signature = sign($message, $secretkey);


if (verify($signature, $message, $publickey)) {
    echo 'OK', "\n";
} else {
    echo "NO","\n";
}

if (verify($signature, $wmessage, $publickey)) {
    echo 'OK', "\n";
} else {
    echo "NO","\n";
}
