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
        $uri = preg_split( "/(\/|\?)/", rtrim(filter_var($uri, FILTER_SANITIZE_URL), '/'));
        $uri[0] = (empty($uri[0])) ? $this->defControllerName : $uri[0]; //TODO maybe that's not right
        $uri[1] = (empty($uri[1])) ? $this->defActionName : $uri[1];

        $componentsNames = $this->checkRoutes($uri[0]);
        $componentsNames = ($componentsNames == false) ? $this->getNames($uri) : $componentsNames;

        try {
            $this->callComponents($componentsNames);
        } catch (ExceptionErrorPage $e) {
            $e->createErrorPage('404');
        }    
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

    /**
     * Find out names of controller, action and view in routes file
     * @param array $uri With uri
     * @return array or false;
     */
    private function checkRoutes($uri)
    {
        $names = [];
        foreach ($this->routes as $uriPattern => $value) {
            if ($uri == $uriPattern) {
                $names['controller'] = 'Controller' . ucfirst($value['controller']);
                $names['action']     = 'action' . ucfirst($value['action']);
                $names['view']       = 'View' . ucfirst($value['controller']) . ucfirst($value['action']);
                $names['parametersURI'] = '';
            } else {
                return false;
            }
        }
        return $names;
    }

    /**
     * Find out names of controller, action and view in user uri
     * @param array $uri With uri
     * @return array
     */
    private function getNames($uri)
    {
        $names = [];
        $names['controller'] = 'Controller' . ucfirst($uri[0]);
        $names['action']     = 'action' . ucfirst($uri[1]);
        $names['view']       = 'View' . ucfirst($uri[0]) . ucfirst($uri[1]);

        unset($uri[0], $uri[1]);
        $uri = array_values($uri);
        $names['parametersURI'] = (!empty($uri)) ? $uri : '';

        return $names;
    }

    /**
     * Call controller action
     * @param array $names With names of controller, action and view
     */
    private function callComponents($names)
    {
        $action = $names['action'];
        if (!class_exists($names['controller'])) {
            throw new ExceptionErrorPage();
        }
        if (!method_exists($names['controller'], $names['action'])) {
            throw new ExceptionErrorPage();
        }
        $controllerObject = new $names['controller'];
        $controllerObject->beforeCallAction($action, $names['parametersURI']);
        $dataForPage = $controllerObject->$action($names['parametersURI']);
        $viewRenderObject = new ViewRender($names['view'], $dataForPage);
    }

}
