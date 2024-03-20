<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
    protected $table='shipping_charges';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('shipping_charges.*')
                ->where('shipping_charges.is_delete','=', 0)
                ->orderBy('shipping_charges.id','desc')
                ->paginate(20);
    }
    // static public function CheckDiscount($discount_code)
    // {
    //     return self::select('shipping_charges.*')
    //             ->where('discount_codes.is_delete','=', 0)
    //             ->where('discount_codes.status','=', 0)
    //             ->where('discount_codes.name','=', $discount_code)
    //             ->where('discount_codes.expire_date','>=', date('Y-m-d'))
    //             ->first();
    // }

}
