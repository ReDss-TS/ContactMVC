<?php

class Model_Sessions extends Core_Model
{
    public function issetLogin() 
    {
        if (isset($_SESSION['login'])) {
            return true;
        }
        return false;
    }

    public function authenticationToSession($authData)
    {    
        foreach ($authData as $key => $value) {
            $_SESSION['userId'] = $value['id'];
            $_SESSION['login'] = $value['login'];
        }
    }

    public function recordMessageInSession($addressMsg, $msg)
    {
        $_SESSION['message'][$addressMsg] = $msg;
    }

    private function unsetMessages()
    {
        unset($_SESSION['message']);
    }

    public function getUserID()
    {
        return $_SESSION['userId'];
    }
}
