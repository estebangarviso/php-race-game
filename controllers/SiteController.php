<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\View;
use App\Models\Race\Race;

/**
 * Class SiteController
 * 
 * @author Esteban Garviso <e.garvisovenegas@gmail.com>
 * @package App\Controllers
 */
class SiteController extends Controller
{

    public function home()
    {
        return $this->render('home');
    }

    public function race(Request $request)
    {
        if ($request->isPost()) {
            return (new Race())->start()->displayRaceResults();
        }
    }
}
