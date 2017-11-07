<?php

class CoreRouter
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

    public function start()
    {
        $uri = $this->getURI();
        $uri = explode('/', rtrim(filter_var($uri, FILTER_SANITIZE_URL), '/'));

        $uri[0] = (empty($uri[0])) ? $this->defControllerName : $uri[0]; //TODO maybe that's not right
        $uri[1] = (empty($uri[1])) ? $this->defActionName :$uri[1];

        $controllerName = 'Controller' . ucfirst($uri[0]);
        $actionName = 'action' . ucfirst($uri[1]);
        $viewName = 'View' . ucfirst($uri[0]) . ucfirst($uri[1]);

        unset($uri[0], $uri[1]);
        $parametsURI = $uri; //TODO

        if (!class_exists($controllerName)) {
            foreach ($this->routes as $uriPattern => $value) {
                if ($uri[0] == $uriPattern) {
                    $controllerName = 'Controller' . ucfirst($value['controller']);
                    $actionName = 'action' . ucfirst($value['action']);
                    $viewName = 'View' . ucfirst($value['controller']) . ucfirst($value['action']);
                } else {
                    throw new ExceptionErrorPage('ErrorPage');
                }
            }
        }

        if (!method_exists($controllerName, $actionName)) {
            throw new ExceptionErrorPage('ErrorPage');
        }

        $controllerObject = new $controllerName;
        $dataForPage = $controllerObject->$actionName($parametsURI);

        $viewRenderObject = new ViewRender($viewName, $dataForPage);
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
        return null;
    }

}
