<?php

namespace MahdiMajidzadeh\kavenegar;

use GuzzleHttp\Client;

class Verify
{
    private $base_url;
    private $prefix = 'verify';

    public $status = null;
    public $message = null;

    public function __construct()
    {
        $this->base_url = config('kavenegar.base_url').config('kavenegar.key').'/'.$this->prefix.'/';
    }

    public function lookup($receptor, $template, $token, $token2 = null, $token3 = null, $type = null)
    {
        $params = [
            'receptor' => $receptor,
            'token'    => $token,
            'token2'   => $token2,
            'token3'   => $token3,
            'template' => $template,
            'type'     => $type,
        ];

        return $this->execute('lookup.json', $params);
    }

    private function execute($url, $params)
    {
        $client = new Client([
            'base_uri' => $this->base_url,
        ]);

        $response = $client->request('POST', $url, [
            'form_params' => $params,
        ]);

        $body = (string) $response->getBody();

        $result = json_decode($body);

        $this->status = $result->return->status;
        $this->message = $result->return->message;

        return $result->entries;
    }
}
