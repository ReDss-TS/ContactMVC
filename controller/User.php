<?php

class ControllerUser extends CoreController
{
	function __construct()
    {
       parent::__construct();
    }

    public function actionLogin()
    {
        $sessions = new ModelSessions;

        if ($_POST) {
            $this->authentication();
        }

        if ($sessions->issetLogin() == true) {
            header("Location: /contact/index");
        }
        //generate('class with render form', 'main html file', 'data')
        $this->view->generate('ViewLoginForm', 'MainStructure', $data=null);

    }

    private function authentication()
    {
        $sessions = new Model_Sessions;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];
        $authentication = new Model_User();
        $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
        $auth['is_auth'] == true ? $sessions->authenticationToSession($auth['user']['id'], $auth['user']['login']) : $sessions->recordMessageInSession('auth', $auth);
    }

    public function actionRegister()
    {
        $formData = [];
        $sessions = new Model_Sessions;
        if ($_POST) {
            $formData['validate'] = $this->registration();
        }

        if ($sessions->issetLogin() == true) {
            header("Location: /contact/index");
        }
        //generate('class with render form', 'main html file', 'data')
        $this->view->generate('view_RegisterForm', 'MainStructure', $formData);
    }

    private function registration()
    {
        $sessions = new Model_Sessions;
        $validateObj = new Model_Validate;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];

        $validateList = $validateObj->validateData($arrayData);
        $noEmptyValidateList = array_diff($validateList, array(''));

        if (empty($noEmptyValidateList)) {
            $registr = new Model_User();
            try {
                $result = $registr->register($arrayData['user_login'], $arrayData['user_pass']);
            } catch (Exception $e) {
                echo 'Exception: ',  $e->getMessage(), "\n";//TODO
            }
            $sessions->recordMessageInSession('register', $result['msg']);
            return '';
        } else {
            return $validateList;
        }
    }
}
