<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table='orders';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getRecord()
    {
        $return = order::select('orders.*')
               ->where('is_payment', '=', 1)
               ->where('is_delete', '=', 0)
               ->orderBy('id', 'desc')
               ->paginate(30);

               return $return;
    }

    public function getShipping()
    {
        return $this->belongsTo(ShippingCharge::class,'shipping_id');
    }
    
    public function getItem()
    {
        return $this->hasMany(orderItem::class,'order_id');
    }
}
