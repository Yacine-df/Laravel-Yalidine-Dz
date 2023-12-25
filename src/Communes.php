<?php

namespace Yacinediaf\Yalidine;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

class Communes
{

    private static $resource = "communes";

    public static function find($id = null)
    {
        if ($id == null) {
            throw new InvalidArgumentException();
        }

        $query = [
            'query' => [
                'wilaya_id' => $id
            ]
        ];

        $response =  self::response($query);

        $communes = $response->pluck('name');

        return $communes;
    }


    public static function response($query = [])
    {

        try {

            $response = Yalidine::client()->get(self::$resource, $query);

            $response = collect(json_decode($response->getBody(), true)['data']);

            return $response;
        } catch (GuzzleException $e) {

            return response()->json([

                'error' => $e->getMessage()

            ]);
        }
    }
}
