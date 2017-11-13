<?php

class ControllerContact extends CoreController
{   
    protected $models = ['ModelSessions', 'ModelContact', 'ModelValidateContact'];
    protected $components = ['Auth', 'Values', 'Phones'];
    protected $actionsRequireLogin = ['Index', 'Delete', 'Add'];

    public function actionIndex()
    {   
        $selectedData = $this->ModelContact->selectDataForMainPage();
        return $selectedData;
    }

    public function actionDelete($param)
    {   
        if (isset($param)) {
            $isDeleted = $this->ModelContact->deleteContacts($param[0]);
            $this->ModelContact->isDeleted($isDeleted);
        } else {
            throw new CoreExceptionHandler();
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

    private function getInputValues()
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

    private function insertData($data)
    {
        $results = [];
        $phones = $this->Phones->getPhones($data['user_hPhone'], $data['user_wPhone'], $data['user_cPhone']);

        $results['idContact'] = $this->ModelContact->insertDataToContactList($data);
        $results['phones'] = $this->ModelContact->insertDataToContactPhones($results['idContact'], $phones);
        $results['address'] = $this->ModelContact->insertDataToContactAddress($results['idContact'], $data);
        $isInserted = $this->Values->isInserted($results);
        return $isInserted;
    }


}
