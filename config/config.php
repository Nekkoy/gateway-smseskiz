<?php

return [
    "enabled" => env('SMSESKIZ_ENABLED', false),
    "login" => env('SMSESKIZ_LOGIN', ''),
    "password" => env('SMSESKIZ_PASSWORD', ''),
    "name_sms" => env('SMSESKIZ_SMS_NAME', ''),
    "priority" => env('SMSESKIZ_PRIORITY', 1),
    "prefix" => env('SMSESKIZ_PREFIX', "any"),
    "tags" => env('SMSESKIZ_TAGS', '#smseskiz, #eskiz'),
    "default" => env('SMSESKIZ_DEFAULT', false),
    "devmode" => env('SMSESKIZ_DEVMODE', false),
];
