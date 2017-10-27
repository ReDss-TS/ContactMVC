<?php

function __autoload($class_name) 
{
    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';

    if (!file_exists($filename))
    {
        return FALSE;
    }
    include $filename;
}
