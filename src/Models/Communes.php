<?php

namespace Yacinediaf\Yalidine\Models;

use InvalidArgumentException;
use Yacinediaf\Yalidine\Yalidine;

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
