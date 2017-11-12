<?php

class ModelUser extends CoreModel
{
    public function selectPasswordByLogin($login)
    {
        $dataForEscape['login'] = $login;
        $escapedData = CoreDB::getInstance()->escapeData($dataForEscape);
        $selectQuery = "SELECT * FROM users where login = '" . $escapedData['login'] . "'";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($login, $pass)
    {
        $dataForEscape = [];
        $dataForEscape['login'] = $login;
        $dataForEscape['pass'] = $pass;
        $escapedData = CoreDB::getInstance()->escapeData($dataForEscape);

        $insertUserQuery = "INSERT INTO users (login, pass) VALUES ('" . $escapedData['login'] . "', '" . $escapedData['pass'] . "');";
        $resultInsert = CoreDB::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
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
