<?php

class ExceptionErrorPage extends Exception
{
    public function pageNotFound() {
        http_response_code(404);
        include('my_404.php');
        die();
    }
}
