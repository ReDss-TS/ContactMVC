<?php

class ModelContact extends CoreModel
{
    protected $components = ['Validate'];

    protected $labelsOfContact = [
        'user_name',
        'user_surname',
        'user_mail',
        'bestPhone',
        'user_hPhone',
        'user_wPhone',
        'user_cPhone',
        'user_address1',
        'user_address2',
        'user_city',
        'user_state',
        'user_zip',
        'user_country',
        'user_birthday'
    ];

    public function getLabelsOfContact()
    {
        return $this->labelsOfContact;
    }

    private function getUserID()
    {    
        try {
            $session = new ModelSessions;
            return $session->getUserID();
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n"; //TODO
        }
    }

    public function selectDataForMainPage()
    {
        $userId = $this->getUserID();
        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_phones.phone
                            FROM contact_list 
                                INNER JOIN contact_phones 
                                    ON contact_list.id = contact_phones.contactId
                                        WHERE contact_list.userId      = $userId
                                        AND contact_list.favoritePhone = contact_phones.phoneType";

        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }


    public function deleteContacts($idLine)
    {
        $forEscape['idLine'] = $idLine;
        $escapedData = CoreDB::getInstance()->escapeData($forEscape);
        $userId = $this->getUserID();
        return CoreDB::getInstance()->delete("DELETE FROM contact_list WHERE id = '" . $escapedData['idLine'] . "'AND userId = '" . $userId . "'");
    }

    public function isDeleted($statement)
    {
        $session = new ModelSessions;
        if ($statement === true) {
            $msg['deleted'] = true;
            $session->recordMessageInSession('delete', $msg);
        } else {
            $msg['notDelete'] = true;
            $session->recordMessageInSession('delete', $msg);
        }
        header("Location: /contact/index");
    }

    public function insertDataToContactList($data)
    {
        $data = CoreDB::getInstance()->escapeData($data);
        $insertQuery = "INSERT INTO contact_list (userId, firstName, lastName, email, favoritePhone) VALUES (
            '" . $data['userId'] . "',
            '" . $data['user_name'] . "',
            '" . $data['user_surname'] . "',
            '" . $data['user_mail'] . "',
            '" . $data['bestPhone'] . "'
        )";
        $resultInsert = CoreDB::getInstance()->insertToDB($insertQuery);
        $lastContactID = CoreDB::getInstance()->getLastID($resultInsert);
        return $lastContactID;
    }
    
    public function insertDataToContactPhones($contactID, $data)
    {
        $data = CoreDB::getInstance()->escapeData($data);
        foreach ($data as $key => $value) {
            $insertQuery = "INSERT INTO contact_phones (contactId, phone, phoneType) VALUES (
                '" . $contactID . "',
                '" . $value . "',
                '" . $key . "'
            )";
            $resultInsert = CoreDB::getInstance()->insertToDB($insertQuery);
        }
        return $resultInsert;
    }

    public function insertDataToContactAddress($contactID, $data)
    {
        $data = CoreDB::getInstance()->escapeData($data);
        $insertQuery = "INSERT INTO contact_address (contactId, address1, address2, city, state, zip, country, birthday) VALUES (
            '" . $contactID . "',
            '" . $data['user_address1'] . "',
            '" . $data['user_address2'] . "',
            '" . $data['user_city'] . "',
            '" . $data['user_state'] . "',
            '" . $data['user_zip'] . "',
            '" . $data['user_country'] . "',
            '" . $data['user_birthday'] . "'
        )";
        $resultInsert = CoreDB::getInstance()->insertToDB($insertQuery);
        return $resultInsert;
    }

    public function isInserted($statement)
    {
        $session = new ModelSessions;
        if ($statement === true) {
            $msg['add'] = true;
            $session->recordMessageInSession('insert', $msg);
            header("Location: /contact/index");
        } else {
            $msg['notAdd'] = true;
            $session->recordMessageInSession('insert', $msg);
        }
    }
}
