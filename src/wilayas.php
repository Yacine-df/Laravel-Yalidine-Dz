<?php

namespace Yacinediaf\Yalidine;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class Wilayas
{

    private static $resource = "wilayas";

    public static function all()
    {
        if (Cache::has('wilayas')) {

            return Cache::get('wilayas');
        }

        return self::response();
    }

    public static function response()
    {

        try {

            $response = Yalidine::client()->get(self::$resource);

            $response = collect(json_decode($response->getBody(), true)['data']);

            $result = $response->map(function ($wilaya) {

                return $wilaya['name'];
            });

            Cache::put('wilayas', $result, 120);

            return $result;

        } catch (GuzzleException $e) {

            return response()->json([

                'error' => $e->getMessage()

            ]);
        }
    }
}
