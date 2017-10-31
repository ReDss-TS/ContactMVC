<?php

class View_LoginForm extends View_Helpers_Forms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Login',
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
