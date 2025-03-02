<?php

return [
    'default_page' => 1,
    'per_page' => 10,
    'fe_url' => env('FE_URL', 'localhost'),
    'password_reset_token_expired' => 24,
    'mail' => [
        'reset_password' => [
            'subject' => 'Reset Your Password',
            'template' => 'emails/forgot-password',
        ],
    ],
];
