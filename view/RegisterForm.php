<?php

class ViewRegisterForm extends ViewHelpersForms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Register',
            'submitBtn'  => 'Register',
            'backBtn'    => 'user/login'
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
