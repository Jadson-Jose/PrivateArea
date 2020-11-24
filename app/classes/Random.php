<?php

namespace App\Classes;

class Random
{
    public function teste()
    {
        return 'RANDOM!!!!!';
    }

    public function SMSToken()
    {
        return rand(100000, 999999);
    }
}
