<?php

namespace App\Controllers;

/**
 * Class SiteController
 * 
 * @author Esteban Garviso <e.garvisovenegas@gmail.com>
 * @package App\Controllers
 */
class SiteController
{
    public function home()
    {
        // return Application::$app->router->renderView('home');
        return 'test';
    }

    public function handleRace()
    {
        return 'Post Race Result';
    }
}
