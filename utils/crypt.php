<?php

function encrypt($str, $key  = 'ASLJa7yssdfkajhd')
{
    $cipher = "AES-256-CBC";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $c = openssl_encrypt($str, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $c, $key, true);
    return base64_encode($iv . $hmac . $c);
}

function decrypt($str, $key  = 'ASLJa7yssdfkajhd')
{
    $cipher = "AES-256-CBC";
    $ivlen = openssl_cipher_iv_length($cipher);
    $c = base64_decode($str);
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $c = substr($c, $ivlen + $sha2len);
    $calcmac = hash_hmac('sha256', $c, $key, true);
    if (hash_equals($hmac, $calcmac)) {
        return openssl_decrypt($c, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    }
    return false;
}
