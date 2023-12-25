<?php

namespace Yacinediaf\Yalidine\Models;

use Yacinediaf\Yalidine\Yalidine;

class Parcels
{

    private static $resource = "parcels";

    public static function all()
    {
        // if (Cache::has('wilayas')) {

        //     return Cache::get('wilayas');
        // }

        $parcels =  Yalidine::response(self::$resource);

        return $parcels;
    }
}
