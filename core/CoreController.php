<?php

abstract class CoreController
{
	protected $className;
	protected $view;
	protected $model;

    protected function __construct()
    {
        $this->view = new CoreView();
    }
}
