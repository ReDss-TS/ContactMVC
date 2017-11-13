<?php

class ModelValidateUser extends CoreModel
{
    protected $components = ['Validate'];
    
    protected $validationRules = [
        'user_login' => [
            'notEmpty',
            'isValidLogin'
        ],
        'user_pass' => [
            'notEmpty',
            'isValidPass'
        ]
    ];
}
