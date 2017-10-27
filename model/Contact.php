<?php

class Model_Contact extends Core_Model
{
    private function getUserID()
    {    
        try {
            $session = new Model_Sessions;
            return $session->getUserID();
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n"; //TODO
        }
    }

    public function selectDataForMainPage(Ц)
    {
        $userId = $this->getUserID();
        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_phones.phone
                            FROM contact_list 
                                INNER JOIN contact_phones 
                                    ON contact_list.id = contact_phones.contactId
                                        WHERE contact_list.userId      = $userId
                                        AND contact_list.favoritePhone = contact_phones.phoneType";

        $resultSelect = Includes_DB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }
}
