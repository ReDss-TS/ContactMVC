<?php

class ControllerUser extends CoreController
{
    protected $components = ['ModelSessions', 'ModelUser', 'ModelValidateUser'];
    protected $actionsRequireLogin = [];

    public function actionLogin()
    {
        if ($_POST) {
            $this->authentication();
        }
        if ($this->ModelSessions->issetLogin() == true) {
            header("Location: /contact/index");
        }
        return null;
    }

    private function authentication()
    {
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];
        $auth = $this->ModelUser->authentication($arrayData['user_login'], $arrayData['user_pass']);
        $auth['is_auth'] == true ? $this->ModelSessions->authenticationToSession($auth['user']['id'], $auth['user']['login']) : $this->ModelSessions->recordMessageInSession('auth', $auth);
    }

    public function actionRegister()
    {
        $formData = [];
        if ($_POST) {
            $formData['validate'] = $this->registration();
        }

        if ($this->ModelSessions->issetLogin() == true) {
            header("Location: /contact/index");
        }
        return $formData;
    }

    private function registration()
    {
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];

        $validateList = $this->ModelValidateUser->validateData($arrayData);
        $noEmptyValidateList = array_diff($validateList, array(''));

        if (empty($noEmptyValidateList)) {
            try {
                $result = $this->ModelUser->register($arrayData['user_login'], $arrayData['user_pass']);
            } catch (Exception $e) {
                echo 'Exception: ',  $e->getMessage(), "\n";//TODO
            }
            $this->ModelSessions->recordMessageInSession('register', $result);
            return '';
        } else {
            return $validateList;
        }
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location: /user/login");
    }
}
