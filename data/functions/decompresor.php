<?php

include './data/LZ/LZString.php';
include './data/LZ/LZReverseDictionary.php';
include './data/LZ/LZData.php';
include './data/LZ/LZUtil.php';
include './data/LZ/LZContext.php';

function stringDecrypt($key, $string)
{
    $encrypt_method = 'AES-256-CBC';
    $key_hash = hex2bin(hash('sha256', $key));
    $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
    return $output;
}

function decompress($string)
{
    return LZString::decompressFromEncodedURIComponent($string);
}

?>