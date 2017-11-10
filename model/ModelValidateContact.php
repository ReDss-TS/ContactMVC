<?php

class ModelValidateContact extends ModelPluginValidate
{
    protected $validationRules = [
        'user_name' => [
            'notEmpty',
            'isValidText'
        ],
        'user_surname' => [
            'notEmpty',
            'isValidText'
        ],
        'user_mail' => [
            'notEmpty',
            'isValidEmail'
        ],
        'user_hPhone' => [
            'notEmpty',
            'isValidPhoneNumber'
        ],
        'user_wPhone' => [
            'notEmpty',
            'isValidPhoneNumber'
        ],
        'user_cPhone' => [
            'notEmpty',
            'isValidPhoneNumber'
        ],
        'user_address1' => [
            'notEmpty',
            'isValidAddress'
        ],
        'user_address2' => [
            'notEmpty',
            'isValidAddress'
        ],
        'user_city' => [
            'notEmpty',
            'isValidText'
        ],
        'user_state' => [
            'notEmpty',
            'isValidText'
        ],
        'user_zip' => [
            'notEmpty',
            'isValidZIP'
        ],
        'user_country' => [
            'notEmpty',
            'isValidText'
        ],
        'user_birthday' => [
            'notEmpty',
            'isValidBirthday'
        ]
    ];
}
