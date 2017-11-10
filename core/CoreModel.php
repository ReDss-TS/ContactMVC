<?php

abstract class CoreModel
{
    public function requireLogin()
    {
        $signIn = new ModelSessions;
        $isSignIn = $signIn->issetLogin();
        if (!$isSignIn == true) {
            header("Location: /user/login");
        }
        
    }
}
