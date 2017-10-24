<?php

function __autoload($class_name) 
{
    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';

    $file = AP_SITE.$filename;

    if ( ! file_exists($file))
    {
        return FALSE;
    }
    include $file;
}
