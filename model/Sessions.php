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

    public function authenticationToSession($id, $login)
    {
        $_SESSION['userId'] = $id;
        $_SESSION['login'] = $login;
    }

    public function recordMessageInSession($addressMsg, $msg)
    {
        if (is_array($msg)) {
            $_SESSION['message'][$addressMsg] = $this->createMsg($msg);
        } else {
            $_SESSION['message'][$addressMsg] = $msg;
        }
    }

    private function createMsg($data)
    {
        //should be in the view
        $msg = '';
        if ($data['login'] == false) {
            $msg = 'Login is incorrect';
        } elseif ($data['pass'] == false) {
            $msg = 'Password is incorrect!';
        }
        return $msg;
    }

    public function unsetMessages()
    {
        unset($_SESSION['message']);
    }

    public function getUserID()
    {   
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        } else {
            throw new Exception('userId does not exist');
        }

    }
}
