<?php

namespace Yacinediaf\Yalidine\Models;

use InvalidArgumentException;
use Yacinediaf\Yalidine\Yalidine;

class DeliveryFees
{

    private static $resource = "deliveryfees";


    public static function check($wilayId = null)
    {
        if (is_null($wilayId)) {
            throw new InvalidArgumentException();
        }

        $query = [
            'query' => [
                'wilaya_id' => $wilayId
            ]
        ];

        $response =  Yalidine::response(self::$resource, $query);

        $fees = $response->map(function ($fee) {

            return [
                'wilaya' => $fee['wilaya_name'],
                'home' => $fee['home_fee'],
                'desk' => $fee['desk_fee']
            ];
        });

        return $fees;
    }

}
