<?php

namespace App\Core;

/**
 * Class Router
 * 
 * @author Esteban Garviso <e.garvisovenegas@gmail.com>
 * @package App\Core
 */
class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;


    /**
     * Router constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Route a GET request to a callback.
     * 
     * @param string $path
     * @param $callback
     */
    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Route a POST request to a callback.
     * 
     * @param string $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();

        $callback = $this->routes[$method][$url] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('pagenotfound');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    /**
     * Render a view.
     * 
     * @param string $view
     */
    public function renderView(string $view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Layout content.
     */
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . '/views/layouts/layout.php';
        return ob_get_clean();
    }

    /**
     * View content.
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
