<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table='product_sizes';

    
     public static function getSingle($id)
    {
        return self::find($id);
    }

    static public function deleteRecord($product_id)
    {
        self::where('product_id','=',$product_id)->delete();
    }

}
