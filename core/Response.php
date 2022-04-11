<?php

namespace App\Core;

/**
 * Class Response
 * 
 * @author Esteban Garviso <e.garvisovenegas@gmail.com>
 * @package App\Core
 */
class Response
{
    public function status(int $number)
    {
        http_response_code($number);
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}
