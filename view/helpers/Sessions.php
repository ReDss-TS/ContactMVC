<?php

class View_Helpers_Sessions
{
    public function showMessages()
    {
        $messages = '';
        if (!empty($_SESSION['message'])) {
            foreach ($_SESSION['message'] as $key => $value) {
                $messages .= "<label class = \"msg\">$value</label><br/>";
            }
        }
        //unset($_SESSION['message']);
        return $messages;
    }
}
