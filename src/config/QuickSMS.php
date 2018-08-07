<?php

return [
    /**
     * default gateway provider
     * 
     */
    "default"=>env('QUICKSMS_PROVIDER', 'default'),

    /**
     * all providers
     */
    "providers"=>[
        'default'=>[
            "driver"=>'smslive',
            "owner_email"=>env("SMS_LIVE_OWNER_EMAIL"),
            "subacc"=>env("SMS_LIVE_SUBACC"),
            "subacc_pwd"=>env("SMS_LIVE_SUBACC_PWD"),
            "sender_name"=>env("SMS_LIVE_SENDER_NAME")

        ],
        "smslive"=>[
            "driver"=>'smslive',
            "owner_email"=>env("SMS_LIVE_OWNER_EMAIL",""),
            "subacc"=>env("SMS_LIVE_OWNER_SUBACC",""),
            "subacc_pwd"=>env("SMS_LIVE_OWNER_SUBACC_PWD","")
        ]
    ]
];