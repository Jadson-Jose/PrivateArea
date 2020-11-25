<?php

namespace App\Classes;

use PhpParser\Builder\Function_;

Class Enc 
{
    public function encriptar($valor) 
    {
        return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', 'mJiCCQStbI2n8sDhinl6UbEE9Icvg9Z8', OPENSSL_RAW_DATA, 'qntZZVlUtRhWzG3w'));
    }

}