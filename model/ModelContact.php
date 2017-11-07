<?php

class ModelContact extends CoreModel
{
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
        if ($statement == true) {
            $sessions->recordMessageInSession('delete', $data['deleted'] = false);
            header("Location: index.php");
        } else {
            $sessions->recordMessageInSession('delete', $data['notDelete'] = false);
        }
    }
    
}
