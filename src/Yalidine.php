<?php

namespace Yacinediaf\Yalidine;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Yalidine
{
    public static $apiUrl = "https://api.yalidine.app/v1/";

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


    public static function response($resource, $query = [])
    {

        try {

            $response = Yalidine::client()->get($resource, $query);

            return collect(json_decode($response->getBody(), true)['data']);
        } catch (GuzzleException $e) {

            return response()->json([

                'error' => $e->getMessage(),

            ]);
        }
    }


    public static function request($resource, $data)
    {

        try {

            $response = Yalidine::client()->request('POST', $resource, $data);

            return $response;
        } catch (GuzzleException $e) {

            return response()->json([

                'error' => $e->getMessage(),

            ]);
        }
    }
}
