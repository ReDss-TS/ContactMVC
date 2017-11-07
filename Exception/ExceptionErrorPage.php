<?php

class ExceptionErrorPage extends Exception
{
    public function createPage() {
        http_response_code(404);
        $viewRenderObject = new ViewRender('ViewErrorPage404', '');
    }
}
