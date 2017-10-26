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
        $controllerName = 'Contact'; // default controller Name
        $actionName = 'Index'; // default controller action Name

        $uri = $this->getURI();
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        $uri = rtrim($uri, '/');
        $uri = explode('/', $uri);

        if ( !empty($uri[1]) ) {    
            $controllerName = $uri[2];
        }

        if ( !empty($uri[2]) ) {
            $actionName = $uri[2];
        }

        $controllerFile = "controller/" . ucfirst($controllerName) . ".php";

        if (file_exists($controllerFile)) {
            $result = makeAction($controllerName, $actionName);
        } else ($this->findRouteAction($controllerName) == null) {
            throw new Exception("The file: $controllerName Does not exists.");
            $this->ErrorPage404();
        }
    }

    private function makeAction($controllerName, $actionName)
    {
          $result = null;
           $controllerObject = new $controllerName;
        $actionName = 'action' . ucfirst($actionName);
        if (method_exists($controllerObject, $actionName)) {
              $result = $controllerObject->$actionName();
        } else {
            throw new Exception("The action: $actionName Does not exists.");    
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
                   $result = makeAction($controllerName, $value['action'])
               }
           }
           return $result;
    }

    public function ErrorPage404()
    {

    }

}
