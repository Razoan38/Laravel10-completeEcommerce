<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    
    static public function checkSlug($slug)
    {
        return self::where('slug','=',$slug)->count();
    }
}
