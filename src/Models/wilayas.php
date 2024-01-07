<?php

namespace Yacinediaf\Yalidine\Models;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;
use Yacinediaf\Yalidine\Yalidine;

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

        $response =  Yalidine::response(self::$resource);

        try {
            $wilayas = $response->pluck('name', 'id');
        } catch (\Exception $e) {
            abort(503, 'Connection Issues');
        }

        return $wilayas;
    }

    /**
     * Get the  Wilaya by the id
     */
    public static function find($id = null)
    {
        if (!isset($id)) {
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
