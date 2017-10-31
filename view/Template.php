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
            $session = new View_Helpers_Sessions(); 
            $form = new $content($data);
            echo $session->showMessages();
            echo $form->render();
        ?>
    
    </body>
</html>
