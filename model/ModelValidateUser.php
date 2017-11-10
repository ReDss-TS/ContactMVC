<?php

class ModelValidateUser extends ModelPluginValidate
{
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
