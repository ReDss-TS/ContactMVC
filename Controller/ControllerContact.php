<?php

class ControllerContact extends CoreController
{   
    protected $models = ['ModelSessions', 'ModelContact', 'ModelValidateContact'];
    protected $components = ['Auth', 'Values', 'Phones'];
    protected $actionsRequireLogin = ['Index', 'Delete', 'Add'];

    public function actionIndex($param)
    {   
        $numberOfRecords = $this->ModelContact->getCountFromContactList();
        $selectedData['contacts'] = $this->ModelContact->selectDataForMainPage($param, $numberOfRecords);
        return $selectedData;
    }

    public function actionDelete($param)
    {   
        if (!isset($param)) {
            throw new CoreExceptionHandler();
        } else {
            $isDeleted = $this->ModelContact->deleteContacts($param[2]);
            $this->ModelContact->isDeleted($isDeleted);
        }
    }

    public function actionAdd()
    {  
        $data = [];
        if ($_POST) {    
           $data = $this->addRecord();
        }
        return $data;
    }

    public function actionEdit($param)
    {  
        $inputValues = $this->getValuesForUpdate($param[2]);
        $formData['data'] = $inputValues['data'];
        $formData['validate'] = '';
        $formData['radio'] = $inputValues['selectedRadio'];
        
        if ($_POST) {    
           $formData = $this->editRecord($param[2]);
        }
        return $formData;
    }

    private function addRecord()
    {
        $formData = [];
        $results = false;
        $inputValues = $this->getInputValues();
        $inputValues = $this->Values->addKeyToInputValues($inputValues);

        $validateList = $this->ModelValidateContact->validateData($inputValues);
        $noEmptyValidateList = array_diff($validateList, array(''));
        $data = $this->Values->additionalFields($inputValues);

        if (empty($noEmptyValidateList)) {
            $results = $this->insertData($data);
        } else {
            $formData['data'] = $data;
            $formData['validate'] = $validateList;
            $formData['radio'] = $data['bestPhone'];
        }

        $this->ModelContact->isInserted($results);
        return $formData;
    }

    private function editRecord($param)
    {
        $formData = [];
        $results = false;
        $inputValues = $this->getInputValues();
        $inputValues = $this->Values->addKeyToInputValues($inputValues);

        $validateList = $this->ModelValidateContact->validateData($inputValues);
        $noEmptyValidateList = array_diff($validateList, array(''));
        $data = $this->Values->additionalFields($inputValues);

        if (empty($noEmptyValidateList)) {
            $results = $this->updateData($data, $param);
        } else {
            $formData['data'] = $data;
            $formData['validate'] = $validateList;
            $formData['radio'] = $data['bestPhone'];
        }

        $this->ModelContact->isUpdated($results);
        return $formData;
    }

    public function getInputValues()
    {
        $labelsOfContact = $this->ModelContact->getLabelsOfContact();
        $inputValues = [];
        foreach ($labelsOfContact as $key => $value) {
            if (isset($_POST[$value])) {
                $inputValues[] = $_POST[$value];
            } else {
                $inputValues[] = '';
            }
        }
        return $inputValues;
    }

    public function getValuesForUpdate($recordID)
    {
        $selectedData = $this->ModelContact->selectAllData($recordID);
        $selectedPhones = $this->ModelContact->selectPhones($recordID);
        $phones = $this->Phones->sortPhonesByType($selectedPhones);
        $data = $this->ModelContact->getDataForEdit($selectedData, $phones);
        return $data;
    }

    private function insertData($data)
    {
        $results = [];
        $phones = $this->Phones->getPhones($data['user_hPhone'], $data['user_wPhone'], $data['user_cPhone']);

        $results['idContact'] = $this->ModelContact->insertDataToContactList($data);
        $results['phones'] = $this->ModelContact->insertDataToContactPhones($results['idContact'], $phones);
        $results['address'] = $this->ModelContact->insertDataToContactAddress($results['idContact'], $data);
        $isInserted = $this->Values->isDone($results);
        return $isInserted;
    }

    private function updateData($data, $recordID)
    {
        $results = [];
        $phones = $this->Phones->getPhones($data['user_hPhone'], $data['user_wPhone'], $data['user_cPhone']);

        $results['idContact'] = $this->ModelContact->updateDataInContactList($recordID, $data);
        $results['phones'] = $this->ModelContact->updateDataToContactPhones($recordID, $phones);
        $results['address'] = $this->ModelContact->updateDataToContactAddress($recordID, $data);
        $isInserted = $this->Values->isDone($results);
        return $isInserted;
    }

}
