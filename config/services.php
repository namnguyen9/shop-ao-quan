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

    'facebook' => [
        'client_id' => '488615029187643',
        'client_secret' => '6124d798e82584be4c48870770f92a5b',
        'redirect' => 'https://shop-ao-quan.herokuapp.com/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '1033336236655-b0jkfancou339i3iatrp8sv4ferpe4k6.apps.googleusercontent.com',
        'client_secret' =>'nR01SzmSRatJtYnLVScZo314',
        'redirect' => 'https://shop-ao-quan.herokuapp.com/auth/google/callback',
    ],

];
