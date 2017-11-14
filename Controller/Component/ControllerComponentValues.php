<?php

class ControllerComponentValues
{
    public function addKeyToInputValues($inputValues)
    {
        $ModelContact = new ModelContact;
        $labelsOfContact = $ModelContact->getLabelsOfContact();
        for ($i = 0; $i < count($labelsOfContact); $i++) {
            $data[$labelsOfContact[$i]] = $inputValues[$i];
        }
        return $data;
    }

    public function additionalFields($inputValues)
    {
        $data = $this->addUserID($inputValues);
        $data['bestPhone'] = $this->whichBestPhone($data);
        return $data;
    }

    public function addUserID($inputValues)
    {
        $session = new ModelSessions;
        $userId = $session->getUserID();
        $data = array('userId' => $userId) + $inputValues;
        return $data;
    }

    public function whichBestPhone($data)
    {
        $phones = new ControllerComponentPhones;
        $bestPhone = isset($data['bestPhone']) ? $data['bestPhone'] : '';
        $bestPhone = $phones->choiceBestPhone(
                                            $bestPhone, 
                                            $data['user_hPhone'], 
                                            $data['user_wPhone'], 
                                            $data['user_cPhone']
                                        );
        return $bestPhone;
    }

    public function isDone($result)
    {
        $amount = 0;
        foreach ($result as $key => $value) {
            if (!empty($value)) {
                $amount++;
            }
        }
        if ($amount == count($result)) {
            return true;
        }
        return false;
    }

    public function getValuesForUpdate($recordID)
    {
        $ModelContact = new ModelContact;
        $selectedData = $ModelContact->selectAllData($recordID);
        $selectedPhones = $ModelContact->selectPhones($recordID);

        $phonesObj = new ControllerComponentPhones;
        $phones = $phonesObj->sortPhonesByType($selectedPhones);

        foreach ($selectedData as $key => $value) {
            $valuesForUpdate = [
                'selectedRadio' => $value['favoritePhone'],
                'data' => [
                    'user_name'     => $value['firstName'],
                    'user_surname'  => $value['lastName'],
                    'user_mail'     => $value['email'],
                    'user_hPhone'   => $phones['hPhone'],
                    'user_wPhone'   => $phones['wPhone'],
                    'user_cPhone'   => $phones['cPhone'],
                    'user_address1' => $value['address1'],
                    'user_address2' => $value['address2'],
                    'user_city'     => $value['city'],
                    'user_state'    => $value['state'],
                    'user_zip'      => $value['zip'],
                    'user_country'  => $value['country'],
                    'user_birthday' => $value['birthday'],
                ]
            ];
        }
        return $valuesForUpdate;
    }
}
