<?php

class ControllerContact extends CoreController
{   
    public $labelsOfContact = [
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

    function __construct()
    {
       parent::__construct();
    }

    public function actionIndex()
    {
        $modelUser = new ModelUser;
        $modelUser->requireLogin();
        $modelContact = new Model_Contact;
        $selectedDataForMainPage = $modelContact->selectDataForMainPage();
        $sanitizeData = $modelContact->sanitizeSpecialChars($selectDataForMainPage);
        
        $this->view->generate('ViewMainPage', 'MainStructure', $data=null);
    }

    public function actionDelete()
    {
        $modelUser = new ModelUser;
        $modelUser->requireLogin();
        $delete = new Model_Contact;
        $isDeleted = $delete->deleteContacts($_POST['idLine']);
        $delete->isDeleted($isDeleted);
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location: index.php");
    }

    public function actionAdd()
    {   
        $modelUser = new ModelUser;
        $modelUser->requireLogin();

        if ($_POST) {
            $inputValues = $this->getInputValues();
            //TODO
        }

        $this->view->generate('View_AddContactForm', 'MainStructure', $data=null);
    }

    private function getInputValues()
    {
        $inputValues = [];
        foreach ($this->labelsOfContact as $key => $value) {
            if (isset($_POST[$value])) {
                $inputValues[] = $_POST[$value];
            } else {
                $inputValues[] = '';
            }
        }
        return $inputValues;
    }
}
