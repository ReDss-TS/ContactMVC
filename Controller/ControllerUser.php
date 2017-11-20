<?php

class ControllerUser extends CoreController
{
    protected $models = ['ModelSessions', 'ModelUser', 'ModelValidateUser'];
    protected $components = ['Auth', 'Register'];
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

    public function actionLogout()
    {
        session_destroy();
        header("Location: /user/login");
    }

    private function authentication()
    {
        $auth = $this->Auth->auth($_POST['user_login'], $_POST['user_pass']);
        if ($auth['is_auth'] === true) {
            $this->ModelSessions->authenticationToSession($auth['user']['id'], $auth['user']['login']);
        } else {
            $this->ModelSessions->recordMessageInSession('auth', $auth);
        }
    }

    private function registration()
    {
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];
        
        $validateList = $this->ModelValidateUser->validateData($arrayData);
        $noEmptyValidateList = array_diff($validateList, array(''));

        if (empty($noEmptyValidateList)) {
            try {
                $result = $this->register($arrayData['user_login'], $arrayData['user_pass']);
                $this->ModelSessions->recordMessageInSession('register', $result);
                return '';
            } catch (Exception $e) {
                echo 'Exception: ',  $e->getMessage(), "\n";//TODO
            }
        } else {
            return $validateList;
        }
    }

    public function register($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $ModelUser = new ModelUser;
        $ModelValidateUser = new ModelValidateUser;
        
        $isBusyLogin = $ModelValidateUser->isBusyLogin($ulogin);

        if ($isBusyLogin === true) {
            $msg['busyLogin'] = true;
        } elseif ($isBusyLogin === false) {
            $msg['registered'] = $ModelUser->insertUserIntoDB($ulogin, $upass);
        } else {
            throw new Exception('Error: User data not included');
        }

        return $msg;
    }
}
