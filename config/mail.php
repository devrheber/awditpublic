<?php

return [
    "driver" => "smtp",
//    "host" => "smtp.sendgrid.net",
    "host" => env('MAIL_HOST'),
//    "port" => 587,
    "port" => env('MAIL_PORT'),
    "from" => [
            "address" => "rahul.theappideas@gmail.com",
            "name" => "SEAT App",
    ],
//    "username" =>"apikey",
    "username" => env('MAIL_USERNAME'),
//    "password" => "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",
    "password" => env('MAIL_PASSWORD'),
    "encryption" => "tls",
];
