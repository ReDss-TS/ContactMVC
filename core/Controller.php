<?php

class Core_Controller
{
	protected $className;
	protected $view;
	protected $model;

    private function __construct()
    {
        //$this->className = substr(get_class($this), strpos(get_class($this), "_")+1); // name of Controller's Class
        $this->view = new View();
    }

    public function actionIndex()
    {

    }
}
