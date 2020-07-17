<?php

/**
 * This class handles all routing functions in the app
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020 www.hebronOnline.co.za
 */

namespace App\M_Core;

class Router
{
    private $params;
    private $action;
    private $controller;
    private $request;

    function __construct()
    {
        //Get the resuest URI and split it up to get all the parameters you need
        $url            = $_SERVER['REQUEST_URI'];
        $explodedUrl    = explode('/', $url);
        $resourcesUrl   = array_splice($explodedUrl, 1);

        if (strpos($resourcesUrl[1], '?')) {
            $actionIndex     = strpos($resourcesUrl[1], '?');
            $this->action    = substr($resourcesUrl[1], 0, $actionIndex) ?? null;
            parse_str(substr($resourcesUrl[1], $actionIndex + 1), $this->params);
        } else {
            $this->action = $resourcesUrl[1] ?? null;
            $this->params = array_splice($resourcesUrl, 2);
        }

        $this->controller   = "App\\Controller\\" . ucfirst($resourcesUrl[0]);
    }

    //This function starts the routing proccess after getting all the required variables
    public function route()
    {
        $this->route_to($this->controller . "Controller", $this->action);
    }

    /**
     * This function routes to the requested controller and action
     * @param string $controller is the controller you want to route to
     * @param string $action is the funtion you wnat to hit with your request in the controller
     */
    private function route_to($controller, $action)
    {
        if (class_exists($controller)) {
            $routeController = new $controller();
            if ($action <> null) {
                if (method_exists($routeController, $action)) {
                    $routeController->{$action}($this->params);
                } else $routeController->{"notFound"}();
            } else $routeController->{"Index"}($this->params);
        } else echo "Invalid URL";
    }
}
