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
    /**
     * Set response status code
     *
     * @param integer $number
     */
    public function setStatusCode(int $number)
    {
        http_response_code($number);
    }

    /**
     * Set response header location
     * 
     * @param string $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }
}
