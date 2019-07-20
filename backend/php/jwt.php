<?php
use \Firebase\JWT\JWT;

function encode_jwt($user, $lastminute){

    $token = array(
        "user" => $user,
        "expire" => time() + ($lastminute * 60)
    );
    $privatekey = file_get_contents("../../../privatekey.txt");
    $jwt = JWT::encode($token, $privatekey, 'RS256');

    return $jwt;
}

function decode_jwt($user, $jwt){
    $publickey = file_get_contents("publickey.txt");
    $token = JWT::decode($jwt, $publickey, array('RS256'));
    if($token["user"] !== $user || $token["expire"] < time() ) {
        return false;
    }
    return true;
}