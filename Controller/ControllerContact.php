<?php

class ControllerContact extends CoreController
{   
    protected $components = ['ModelUser', 'ModelContact'];
    protected $actionsRequireLogin = ['Index', 'Delete', 'Add'];

    public function actionIndex()
    {   
        $selectedData = $this->ModelContact->selectDataForMainPage();
        return $selectedData;
    }

    public function actionDelete($param) //TODO how I must validated $param
    {   
        if (isset($param)) {
            $isDeleted = $this->ModelContact->deleteContacts($param);
            $this->ModelContact->isDeleted($isDeleted);
        } else {
            throw new CoreExceptionHandler();
        }
    }

    public function actionAdd()
    {   
        if ($_POST) {
            $inputValues = $this->getInputValues();
            $isInserted = $this->insert($inputValues);
            //TODO
        }

        return $sanitizeData;
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

    private function insert($inputValues)
    {
        
    }
}
