<?php

namespace MahdiMajidzadeh\Kavenegar;

use Illuminate\Support\Facades\Facade;

class KavenegarSMSFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kavenegarSMS';
    }
}