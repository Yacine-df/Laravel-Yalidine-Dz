<?php

namespace Yacinediaf\Yalidine;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

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

        $response =  self::response($query);

        $fees = $response->map(function ($fee) {

            return [
                'wilaya' => $fee['wilaya_name'],
                'home' => $fee['home_fee'],
                'desk' => $fee['desk_fee']
            ];
        });

        return $fees;
    }


    public static function response($query = [])
    {

        try {

            $response = Yalidine::client()->get(self::$resource, $query);

            return collect(json_decode($response->getBody(), true)['data']);
        } catch (GuzzleException $e) {

            return response()->json([

                'error' => $e->getMessage()

            ]);
        }
    }
}
