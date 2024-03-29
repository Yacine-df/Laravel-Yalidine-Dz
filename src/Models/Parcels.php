<?php

namespace Yacinediaf\Yalidine\Models;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Yacinediaf\Yalidine\Yalidine;

class Parcels
{

    private static $resource = "parcels";


    public static function create($data)
    {

        try {

            /**
             * encode the passed data to json 
             * and wrap it within an array which 
             * has a body key to avoid the bad request
             */

            $postdata = ['body' => json_encode($data)];

            /**
             * Here if the request is succesfully done
             *  you will get guzzle response 
             * and 200 status
             */

            $response = Yalidine::client()->request('POST', self::$resource, $postdata);

            /**
             * In order to pull the result of the response
             * we decode the json
             */

            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {

            return response()->json([

                'error' => $e->getMessage(),

            ]);
        }
    }


    public static function all()
    {
        if (Cache::has(self::$resource)) {

            return Cache::get(self::$resource);
        }

        $parcels =  Yalidine::response(self::$resource);



        try {
            $parcels = $parcels->map(function ($parcel) {

                return [
                    'tracking' => $parcel['tracking'],
                    'fullName' => $parcel['firstname'] . ' ' . $parcel['familyname'],
                    'phone'    => $parcel['contact_phone'],
                    'adress'   => $parcel['address'],
                    'stop_desk' => $parcel['stopdesk_name'],
                    'to_wilaya' => $parcel['to_wilaya_name'],
                    'to_commune' => $parcel['to_commune_name'],
                    'product'   => $parcel['product_list'],
                    'price'     => $parcel['price'],
                    'insurance' => (bool) $parcel['do_insurance'],
                    'last_status' => $parcel['last_status'],
                    'current_wilaya' => $parcel['current_wilaya_name'],
                    'payment_status' => $parcel['payment_status'],
                    'label' => $parcel['label']
                ];
            });
        } catch (\Exception $e) {
            abort(503, 'Connection Issues');
        }

        return $parcels;
    }
}
