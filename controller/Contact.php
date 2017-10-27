<?php

class Controller_Contact extends Core_Controller
{
    function __construct()
    {
       parent::__construct();
    }

    public function actionIndex()
    {
        $this->requireLogin();
        $modelContact = new Model_Contact;
        $selectedDataForMainPage = $modelContact->selectDataForMainPage();
        //TODO
    }

    private function requireLogin()
    {
        $signIn = new Model_Sessions;
        $isSignIn = $signIn->issetLogin();
        if (!$isSignIn == true) {
            header("Location: user/login"); // don't know how it should be
        }
        
    }
}
