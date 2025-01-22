<?php
namespace Lib;

class Security{
    final public static function encryptPassw(string $passw){

    }
    final public static function validatePassw(string $passw, string $passwhash){

    }
    final public static function secretKey():string{
        return $_ENV['SECRET_KEY'];
    }
}