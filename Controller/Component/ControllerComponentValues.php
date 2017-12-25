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
}
