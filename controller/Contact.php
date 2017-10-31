<?php

class Controller_Contact extends Core_Controller
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
        $this->requireLogin();
        $modelContact = new Model_Contact;
        $selectedDataForMainPage = $modelContact->selectDataForMainPage();
        $sanitizeData = $modelContact->sanitizeSpecialChars($selectDataForMainPage);
        
        $this->view->generate('View_MainTable', 'template', $data=null);
    }

    private function requireLogin()
    {
        $signIn = new Model_Sessions;
        $isSignIn = $signIn->issetLogin();
        if (!$isSignIn == true) {
            header("Location: user/login"); // don't know how it should be
        }
        
    }

    public function actionDelete()
    {
        $this->requireLogin();
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
        $this->requireLogin();

        if ($_POST) {
            $inputValues = $this->getInputValues();
            //TODO
        }

        $this->view->generate('View_AddContactForm', 'template', $data=null);
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
