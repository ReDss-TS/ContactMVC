<?php

abstract class CoreController
{

    function __construct()
    {
        foreach ($this->components as $key => $property) {
            $this->{$property} = new $property;
        }
    }
}
