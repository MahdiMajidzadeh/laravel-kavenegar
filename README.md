# Laravel Kavenegar

[![StyleCI](https://styleci.io/repos/110477751/shield?branch=master)](https://styleci.io/repos/110477751)
[![packagist](https://img.shields.io/badge/packagist-v0.2-green.svg?style=flat-square)](https://packagist.org/packages/mahdimajidzadeh/kavenegar)
![status](https://img.shields.io/badge/status-stable-blue.svg?style=flat-square)


## Install

Via Composer

``` bash
$ composer require mahdimajidzadeh/kavenegar
```
If you do not run Laravel 5.5 (or higher), then add the service provider in config/app.php:

```
MahdiMajidzadeh\kavenegar\KavenegarServiceProvider:class
```

If you do run the package on Laravel 5.5+, package auto-discovery takes care of the magic of adding the service provider.

You must publish the configuration to provide an own service provider stub.

``` bash
$ php artisan vendor:publish --provider="MahdiMajidzadeh\kavenegar\KavenegarServiceProvider"
```

## Usage
See documention for params and others at [kavenegar docs](http://kavenegar.com/rest.html)

``` php
$sms = new SMS();
$result = $sms->send($receptor, $message);

$sms->status; // like 200
$sms->message; // like "تایید شد"
```

All available methods:
``` php
$sms = new SMS();
$sms->send(...);
$sms->sendArray(...);
$sms->status(...);
$sms->statusLocalMessageid(...);
$sms->select(...);
$sms->selectOutbox(...);
$sms->latestOutbox(...);
$sms->countOutbox(...);
$sms->cancel(...);
$sms->countInbox(...);
$sms->receive(...);
$sms->countPostalcode(...);
$sms->sendByPostalcode(...);

$verify = new Verify();
$verify->lookup(...);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
