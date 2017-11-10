<?php

abstract class CoreController
{

    function __construct()
    {
        foreach ($this->components as $key => $property) {
            $this->{$property} = new $property;
        }
    }

    public function beforeFilter($action, $params)
    {
    	foreach ($this->actionsRequireLogin as $key => $value) {
    		if ('action' . $value === $action) {
    			$this->ModelUser->requireLogin();
    		}
    	}
    }
}
