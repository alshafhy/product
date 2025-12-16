<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    // 'google' => [
    //     'app_name' => 'demo-test',
    //     'client_id' => '288899856244-nc0ro0fiemp9jknqvipl2uc436tio3fe.apps.googleusercontent.com',
    //     'client_secret' => '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',
    //     'api_key' => '1//04n1ZzJbZUJfICgYIARAAGAQSNwF-L9IrJQD1gajO8bu6F_SIRFzFln8bCXhvtVVDXIYl1S2rT_I5gt1kcyu4r6osUqkIJJYq-AI',
    // ],

];
