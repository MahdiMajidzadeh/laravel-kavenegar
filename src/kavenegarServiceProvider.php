<?php

namespace MahdiMajidzadeh\kavenegar;

use Illuminate\Support\ServiceProvider;

class kavenegarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/kavenegar.php' => config_path('kavenegar.php'),
        ]);
    }

    public function register()
    {
        //
    }
}