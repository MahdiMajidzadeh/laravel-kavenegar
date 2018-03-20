<?php

namespace MahdiMajidzadeh\Kavenegar;

use Illuminate\Support\ServiceProvider;

class KavenegarServiceProvider extends ServiceProvider
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
