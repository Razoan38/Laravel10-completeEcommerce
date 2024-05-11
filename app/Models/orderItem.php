<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItem extends Model
{
    use HasFactory;
    protected $table='order_items';


    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
