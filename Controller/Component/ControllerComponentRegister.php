<?php

class ControllerComponentRegister
{
    public function register($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $ModelUser = new ModelUser;

        $isBusyLogin = $this->isBusyLogin($ulogin);

        if ($isBusyLogin === true) {
            $msg['busyLogin'] = true;
        } elseif ($isBusyLogin === false) {
            $msg['registered'] = $ModelUser->insertUserIntoDB($ulogin, $upass);
        } else {
            throw new Exception('Error: User data not included');
        }

        return $msg;
    }

    private function isBusyLogin($login)
    {
        $ModelUser = new ModelUser;
        $selectedLogin = $ModelUser->selectPasswordByLogin($login);
        if (is_object($selectedLogin)){
            return false;
        } else {
            return true;
        }
    }
}
