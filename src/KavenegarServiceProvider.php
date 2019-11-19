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
        $this->app->singleton('kavenegarSMS', function () {
            return new KavenegarSMS();
        });

        $this->app->singleton('kavenegarVerify', function () {
            return new KavenegarVerify();
        });
    }
}
