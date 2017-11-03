<?php

abstract class CoreView
{
    /**
     * generate all html code
     * @param string $content With a name class with render form in view folder
     * @param string $mainStructure With a name php file with general structure
     * @param string $data With a data for render form such as input data, validated data
     * @return string
     */
    function generate($content, $mainStructure, $data = null)
    {
        include "view/$MainStructure.php";
    }
}
