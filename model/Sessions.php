<?php

class ModelSessions extends CoreModel
{   
    protected $msgs = [
        'login'      => 'Login is incorrect',
        'pass'       => 'Password is incorrect',
        'deleted'    => 'Record deleted successfully!',
        'notDelete'  => 'Record has not been deleted!',
        'busyLogin'  => 'Login is busy! Please enter another login',
        'registered' => 'You have successfully registered!',


    ];

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
        foreach ($msgs as $key => $value) {
            if (isset($data['$key'])) {
                if ($data['$key'] == true) {
                   $msg = $value;
                }
            }
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
