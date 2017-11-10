<?php

class ViewUserLogin extends ViewHelpersForms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Login',
            'submitBtn'  => 'Enter',
            'backBtn'    => 'user/Register'
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
