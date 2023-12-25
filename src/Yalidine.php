<?php

namespace Yacinediaf\Yalidine;

use GuzzleHttp\Client;

class Yalidine
{
    private static $apiUrl = "https://api.yalidine.app/v1/";

    public static function client()
    {

        $client = new Client([

            'base_uri' => self::$apiUrl,
            'headers' => [
                'X-API-ID' => config('yalidine.key'),
                'X-API-TOKEN' => config('yalidine.token')
            ]
        ]);

        return $client;
    }
}
