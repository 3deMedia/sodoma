<?php

return [
    'client_id'=>env('PAYPAL_CLIENT_ID'),
    'client_secret'=>env('PAYPAL_SECRET'),
    'seetings'=>[
        'mode'=>env('PAYPAL_MODE','live'),
        'http.ConnectionTimeOut'=>30,
        'log.LogEnabled'=>true,
        'log.FileName'=>storage_path('/logs/paypal.log'),
        'log.LogLevel'=>'Error',
    ]
];
