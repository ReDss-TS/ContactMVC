<?php

class ViewUserLogin extends CoreView
{
    //what render (form or table or both)
    protected $thatRender = ['form'];
    
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
