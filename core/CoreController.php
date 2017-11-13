<?php

abstract class CoreController
{

    function __construct()
    {
        foreach ($this->models as $key => $property) {
            $this->{$property} = new $property;
        }

        foreach ($this->components as $key => $property) {
        	$class = 'ControllerComponent' . $property;
            $this->{$property} = new $class;
        }
    }

    public function beforeCallAction($action, $params)
    {
    	foreach ($this->actionsRequireLogin as $key => $value) {
    		if ('action' . $value === $action) {
    			$this->Auth->isAuth();
    		}
    	}
    }
}
