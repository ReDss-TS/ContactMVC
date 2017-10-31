<?php

class Model_User extends Core_Model
{
    public function selectPasswordByLogin($login)
    {
        $dataForEscape['login'] = $login;
        $escapedData = Includes_DB::getInstance()->escapeData($dataForEscape);
        $selectQuery = "SELECT * FROM users where login = '" . $escapedData['login'] . "'";
        $resultSelect = Includes_DB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($login, $pass)
    {
        $dataForEscape = [];
        $dataForEscape['login'] = $login;
        $dataForEscape['pass'] = $pass;
        $escapedData = Includes_DB::getInstance()->escapeData($dataForEscape);

        $insertUserQuery = "INSERT INTO users (login, pass) VALUES ('" . $escapedData['login'] . "', '" . $escapedData['pass'] . "');";
        $resultInsert = Includes_DB::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
    }

    public function authentication($ulogin, $upass)
    {   
        $msg = [
            'is_auth' => false,
            'user' => '',
            'login' => false,
            'pass' => false
        ];

        $upass = md5($upass);
        $selectedUserData = $this->selectLogin($ulogin, $upass);
        if (is_array($selectedUserData)) {
                if ($selectedUserData[0]['pass'] === $upass) {
                    $msg['is_auth'] = true;
                    $msg['user'] = $selectedUserData;
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

    private function selectLogin($ulogin, $upass)
    {
        $selectedPasswordByLogin = $this->selectPasswordByLogin($ulogin);
        return $selectedPasswordByLogin;
    }


    public function register($ulogin, $upass) //TODO
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $selectedLogin = $this->createSelectLoginQuery($ulogin);
        if (is_array($selectedLogin)) {
            $msg['busyLogin'] = true;
        } else {
            $insertedUser = $this->createInsertUserQuery($ulogin, $upass);
            if ($insertedUser === true) {
                $msg['registered'] = true;
            } else {
                throw new Exception('Error: User data not included');
            }           
        }
        return $msg;
    }

    private function createSelectLoginQuery($ulogin)
    {
        return $this->selectPasswordByLogin($ulogin);
    }

    private function createInsertUserQuery($ulogin, $upass)
    {
        return $this->insertUserIntoDB($ulogin, $upass);
    }

}
