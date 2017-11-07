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
        return null;

    }

    private function authentication()
    {
        $sessions = new ModelSessions;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];
        $authentication = new ModelUser();
        $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
        $auth['is_auth'] == true ? $sessions->authenticationToSession($auth['user']['id'], $auth['user']['login']) : $sessions->recordMessageInSession('auth', $auth);
    }

    public function actionRegister()
    {
        $formData = [];
        $sessions = new ModelSessions;
        if ($_POST) {
            $formData['validate'] = $this->registration();
        }

        if ($sessions->issetLogin() == true) {
            header("Location: /contact/index");
        }
        return $formData;
    }

    private function registration()
    {
        $sessions = new ModelSessions;
        $validateObj = new ModelValidate;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];

        $validateList = $validateObj->validateData($arrayData);
        $noEmptyValidateList = array_diff($validateList, array(''));

        if (empty($noEmptyValidateList)) {
            $registr = new ModelUser();
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
