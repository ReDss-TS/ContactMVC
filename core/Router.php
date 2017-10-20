<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = 'config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns REQUEST string
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function start()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~", $uri)) {
                $segments = explode('/', $path);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $controllerFile = "controllers/" . $controllerName . ".php";

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();

                if ($result != null) {
                    break;
                }

            }
        }
    }
}
