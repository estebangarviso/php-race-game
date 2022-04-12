<?php

namespace App\Core;

use App\Core\Application;

/**
 * Class Router
 * 
 * @author Esteban Garviso <e.garvisovenegas@gmail.com>
 * @package App\Core
 */
class View
{
    public static function renderView($view, array $params)
    {
        $layoutName = Application::$app->layout;
        if (Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }
        $viewContent = self::renderViewOnly($view, $params);
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public static function renderViewOnly($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
