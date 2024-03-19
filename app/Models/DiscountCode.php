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

}
