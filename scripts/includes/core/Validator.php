<?php

namespace App;

class Validator
{
    static function length($str, $min, $max){
        return( preg_match("/^[a-zA-Z]{".$min.",".$max."}$/", $str));
    }
    static function email($email){
        return(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email));
    }
}