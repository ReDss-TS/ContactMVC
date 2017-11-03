<?php

class ModelContact extends CoreModel
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

    public function selectDataForMainPage()
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

    public function sanitizeSpecialChars($data)
    {
        $filteredResult = [];
        $keys = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $result = $this->sanitizeSpecialChars($value); 
                    $filteredResult[$key] = $result;
                } else {
                    $filteredResult[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            return $filteredResult;
        }
    }

    public function deleteContacts($idLine)
    {
        $forEscape['idLine'] = $idLine;
        $escapedData = Includes_DB::getInstance()->escapeData($forEscape);
        $userId = $this->getUserID();
        return Includes_DB::getInstance()->delete("DELETE FROM contact_list WHERE id = '" . $escapedData['idLine'] . "'AND userId = '" . $userId . "'");
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
