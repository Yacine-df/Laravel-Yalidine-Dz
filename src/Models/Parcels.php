<?php

namespace Yacinediaf\Yalidine\Models;

use Illuminate\Support\Facades\Cache;
use Yacinediaf\Yalidine\Yalidine;

class Parcels
{

    private static $resource = "parcels";

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
