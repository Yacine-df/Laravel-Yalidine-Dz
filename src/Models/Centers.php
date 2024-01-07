<?php

namespace Yacinediaf\Yalidine\Models;

use InvalidArgumentException;
use Yacinediaf\Yalidine\Yalidine;

class Centers
{
    private static $resource = "centers";

    /**
     * Find Centers using a given wilaya id
     * centers are yalidine's desks in a specific wilaya
     */

    public static function findByWilaya($id = null)
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

        try {

            $centers = $response->pluck('name', 'center_id');
        } catch (\Exception $e) {

            abort(503, 'Connection Issues');
        }

        return $centers;
    }
}
