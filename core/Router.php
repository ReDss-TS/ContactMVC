<?php

class Core_Router
{
    private $routes;

    // default controller Name/controller action Name
    private $defControllerName = "Contact";
    private $defActionName = "Index";

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
        return "$this->defControllerName/$this->defActionName";
    }

    public function start()
    {
        $controllerName = $this->defControllerName;
        $actionName = $this->defActionName;

        $uri = $this->getURI();
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        $uri = rtrim($uri, '/');
        $uri = explode('/', $uri);

        if ( !empty($uri[1]) ) {    
            $controllerName = $uri[1];
        }

        if ( !empty($uri[2]) ) {
            $actionName = $uri[2];
        }

        $controllerFile = "controller/" . ucfirst($controllerName) . ".php";

        if (file_exists($controllerFile)) {
            $result = $this->makeAction($controllerName, $actionName);
        } elseif ($this->findRouteAction($controllerName) == null) {
            $this->ErrorPage404();
        }
    }

    private function makeAction($controllerName, $actionName)
    {
        $controllerName = "controller_$controllerName";
        $result = null;
        $controllerObject = new $controllerName;
        $actionName = 'action' . ucfirst($actionName);
        if (method_exists($controllerObject, $actionName)) {
            $result = $controllerObject->$actionName();
        } else {    
            $this->ErrorPage404();
        }
        return $result;
    }

    private function findRouteAction($name)
    {    
        $result = null;
        foreach ($this->routes as $uriPattern => $value) {
            if ($name == $uriPattern) {
                $controllerName = ucfirst($value['controller']);
                $result = $this->makeAction($controllerName, $value['action']);
            }
        }
        return $result;
    }

    public function ErrorPage404()
    {

    }

}
