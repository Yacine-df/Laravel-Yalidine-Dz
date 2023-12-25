<?php

namespace Yacinediaf\Yalidine;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

class Wilayas
{

    private static $resource = "wilayas";

    /**
     * Get all the wilayas filter unecessary data 
     * you can return all the prperty by removing the [data] property
     * in json decode
     * After getting the wilayas they will be cached
     *  in order to avoid calling the api again
     */
    public static function all()
    {
        if (Cache::has('wilayas')) {

            return Cache::get('wilayas');
        }

        $response =  self::response();

        $wilayas = $response->pluck('name');

        return $wilayas;
    }

    /**
     * Get the  Wilaya by the id
     */
    public static function find($id = null)
    {
        if ($id == null) {
            throw new InvalidArgumentException;
        }

        $query = [
            'query' => [
                'id' => $id
            ]
        ];

        return Yalidine::response(self::$resource, $query);
    }
}
