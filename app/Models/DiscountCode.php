<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    
    protected $table='discount_codes';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('discount_codes.*')
                ->where('discount_codes.is_delete','=', 0)
                ->orderBy('discount_codes.id','desc')
                ->paginate(20);
    }
    static public function CheckDiscount($discount_code)
    {
        return self::select('discount_codes.*')
                ->where('discount_codes.is_delete','=', 0)
                ->where('discount_codes.status','=', 0)
                ->where('discount_codes.name','=', $discount_code)
                ->where('discount_codes.expire_date','>=', date('Y-m-d'))
                ->first();
    }

}
