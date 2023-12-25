<?php

namespace Yacinediaf\Yalidine;

use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

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
