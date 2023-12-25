<?php

namespace Yacinediaf\Yalidine\Models;

use InvalidArgumentException;
use Yacinediaf\Yalidine\Yalidine;

class Histories
{

    private static $resource = "histories";


    public static function all()
    {
        // if (Cache::has('wilayas')) {

        //     return Cache::get('wilayas');
        // }

        $allHistories = Yalidine::response(self::$resource);

        return $allHistories;
    }

    /**
     * Get the  Wilaya by the id
     */
    public static function find($tracking = null)
    {
        if ($tracking == null) {
            throw new InvalidArgumentException();
        }

        $query = [
            'query' => [
                'tracking' => $tracking
            ]
        ];

        return Yalidine::response(self::$resource, $query);
    }
}
