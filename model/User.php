<?php

class Model_User extends Core_Model
{
    public function selectPasswordByLogin($login)
    {
        $dataForEscape['login'] = $login;
        $escapedData = Include_DB::getInstance()->escapeData($dataForEscape);
        $selectQuery = "SELECT * FROM users where login = '" . $escapedData['login'] . "'";
        $resultSelect = Include_DB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($login, $pass)
    {
        $dataForEscape = [];
        $dataForEscape['login'] = $login;
        $dataForEscape['pass'] = $pass;
        $escapedData = Include_DB::getInstance()->escapeData($dataForEscape);

        $insertUserQuery = "INSERT INTO users (login, pass) VALUES ('" . $escapedData['login'] . "', '" . $escapedData['pass'] . "');";
        $resultInsert = Include_DB::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
    }
}
