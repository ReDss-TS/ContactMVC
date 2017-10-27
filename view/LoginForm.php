<?php

class view_LoginForm extends view_helpers_Forms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Login',
            'actionFile' => 'Login',
            'submitBtn'  => 'Enter',
            'backBtn'    => 'Register'
    ];

    //structure of the input field
    protected $structure  = [
            [
                'name'  => 'user_login',
                'label' => 'Login',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_pass',
                'label' => 'Password',
                'type'  => 'Password'
            ]
    ];
    
}
