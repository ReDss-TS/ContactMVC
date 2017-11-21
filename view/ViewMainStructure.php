<!DOCTYPE html>
<html>
    <head>
        <link href="/styles/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="header" id="myHead">
            <h3>
                CONTACT MANAGEMENT
            </h3>
        </div>
        <hr/>

        <?php
            $session = new ViewHelpersSessions();
            if (class_exists($view)) { //TODO
                $content = new $view($data);
                $session->showMessages();
                $content->render($data);
            }
        ?>
    
    </body>
</html>
