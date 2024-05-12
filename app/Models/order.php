<?php

namespace App\Models;

use Request;
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

    // static public function getRecord()
    // {
    //     $return = order::select('orders.*')
    //            ->where('is_payment', '=', 1)
    //            ->where('is_delete', '=', 0)
    //            ->orderBy('id', 'desc')
    //            ->paginate(30);

    //            return $return;
    // }


    static public function getRecord()
    {
        $return = order::select('orders.*');

              if(!empty(Request::get('id'))) 
              {
                $return = $return->where('id', '=', Request::get('id'));
              }

              if(!empty(Request::get('first_name'))) 
              {
                $return = $return->where('first_name', 'like', '%'.Request::get('first_name').'%' );
              }

              if(!empty(Request::get('last_name'))) 
              {
                $return = $return->where('last_name', 'like', '%'.Request::get('last_name').'%' );
              }

              if(!empty(Request::get('email'))) 
              {
                $return = $return->where('email', 'like', '%'.Request::get('email').'%' );
              }
              if(!empty(Request::get('phone'))) 
              {
                $return = $return->where('phone', 'like', '%'.Request::get('phone').'%' );
              }
              if(!empty(Request::get('country'))) 
              {
                $return = $return->where('country', 'like', '%'.Request::get('country').'%' );
              }

              if(!empty(Request::get('state'))) 
              {
                $return = $return->where('state', 'like', '%'.Request::get('state').'%' );
              }
              
              if(!empty(Request::get('city'))) 
              {
                $return = $return->where('city', 'like', '%'.Request::get('city').'%' );
              }

              if(!empty(Request::get('discount_code'))) 
              {
                $return = $return->where('discount_code', 'like', '%'.Request::get('discount_code').'%' );
              }

              if(!empty(Request::get('payment_method'))) 
              {
                $return = $return->where('payment_method', 'like', '%'.Request::get('payment_method').'%' );
              }

              if(!empty(Request::get('form_date'))) 
              {
                $return = $return->where('created_at', '>=', Request::get('form_date') );
              }
              if(!empty(Request::get('to_date'))) 
              {
                $return = $return->where('created_at', '<=', Request::get('to_date'));
              }
        
        $return = $return->where('is_payment', '=', 1)
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
