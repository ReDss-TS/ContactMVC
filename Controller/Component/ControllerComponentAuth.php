<?php

class ControllerComponentAuth
{
    public function isAuth($ulogin, $upass)
    {   
        $msg = [
            'is_auth' => false,
            'user' => '',
            'login' => false,
            'pass' => false
        ];

        $upass = md5($upass);
        $modelUser = new ModelUser;

        $selectedUserData = $modelUser->selectPasswordByLogin($ulogin);
        
        if (is_array($selectedUserData)) {
                if ($selectedUserData[0]['pass'] === $upass) {
                    $msg['is_auth'] = true;
                    $msg['user'] = $selectedUserData[0];
                } else {
                    $msg['is_auth'] = false;
                    $msg['pass'] = true;
                }
        } elseif ($selectedUserData->num_rows == 0) {
            $msg['is_auth'] = false;
            $msg['login'] = true;
        }
        return $msg;
    }

}
