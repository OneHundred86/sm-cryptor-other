<?php

namespace Oh86\OtherSmCryptor;

use Illuminate\Support\ServiceProvider;
use Oh86\OtherSmCryptor\Cryptor\OtherGMCryptor;
use Oh86\SmCryptor\Facades\Cryptor;
use Oh86\OtherSmCryptor\Api\OtherGMApi;

class OtherSmCryptorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Cryptor::extend('other', function ($app, $config) {
            $api = new OtherGMApi($config);
            return new OtherGMCryptor($api);
        });
    }
}
