<?php

namespace App\Classes;

use PhpParser\Builder\Function_;

class Enc
{
    public function encriptar($valor)
    {
        return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', 'mJiCCQStbI2n8sDhinl6UbEE9Icvg9Z8', OPENSSL_RAW_DATA, 'qntZZVlUtRhWzG3w'));
    }


    public  function desencriptar($valor_encriptado)
    {
        if (strlen($valor_encriptado) % 2 != 0) {
            return null;
        }

        return openssl_decrypt(hex2bin($valor_encriptado), 'aes-256-cbc', 'mJiCCQStbI2n8sDhinl6UbEE9Icvg9Z8', OPENSSL_RAW_DATA, 'qntZZVlUtRhWzG3w');
    }
}
