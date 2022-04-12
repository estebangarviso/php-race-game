<?php

namespace App\Core;

/**
 * Class Request
 * 
 * @author Esteban Garviso <e.garvisovenegas@gmail.com>
 * @package App\Core
 */
class Request
{
    /**
     * Get URL without query string
     * 
     * @return string
     */
    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        return $path;
    }

    /**
     * Get method of request in lowercase (GET, POST)
     * 
     * @return string
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get if request method is GET
     * 
     * @return bool
     */
    public function isGet()
    {
        return $this->method() === 'get';
    }

    /**
     * Get if request method is POST
     * 
     * @return bool
     */
    public function isPost()
    {
        return $this->method() === 'post';
    }

    /**
     * Get request body as array
     * 
     * @return array
     */
    public function getBody()
    {
        $body = [];

        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
            }
        }

        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
            }
        }

        return $body;
    }
}
