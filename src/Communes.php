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

        $response =  Yalidine::response(self::$resource, $query);

        $communes = $response->pluck('name');

        return $communes;
    }
}
