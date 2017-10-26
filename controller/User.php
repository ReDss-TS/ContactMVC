<?php

class Controller_User extends Core_Controller
{
	function __construct()
	{
		$this->view = new View();
	}

    public function actionLogin()
    {
        $sessions = new Model_Sessions;

        if ($_POST) {
            $this->authentication();
        }

        if ($sessions->issetLogin() == true) {
            header("Location: index.php");
        }
       $this->view->generate('portfolio_view.php', 'template.php', $data);

    }

    public function authentication($sessions)
    {
    	$sessions = new Model_Sessions;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];
        $authentication = new Auth();
        $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
        $auth['is_auth'] == true ? $sessions->authenticationToSession($auth['user']) : $sessions->recordMessageInSession('auth', $auth['error_msg']);
    }
}
