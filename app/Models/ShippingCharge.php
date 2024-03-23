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
    static public function getRecordActive()
    {
        return self::select('shipping_charges.*')
                ->where('shipping_charges.is_delete','=', 0)
                ->where('shipping_charges.status','=', 0)
                ->orderBy('shipping_charges.id','asc')
                ->get();
    }
   

}
