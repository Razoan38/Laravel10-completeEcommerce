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
    static public function getRecord()
    {
        return self::select('products.*', 'users.name as created_by_name')
                    ->join('users','users.id','=','products.created_by')
                    ->where('products.is_delete','=', 0)
                    ->orderBy('products.id','desc')
                    ->paginate(30);
    }
    
    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        $return = Product::select('products.*', 'users.name as created_by_name','categories.category_name as category_name',
        'categories.category_slug as category_slug' ,'sub_categories.subcategory_name as sub_category_name',
        'sub_categories.subcategory_slug as sub_category_slug')
                    ->join('users','users.id','=','products.created_by')
                    ->join('categories','categories.id','=','products.category_id')
                    ->join('sub_categories','sub_categories.id','=','products.subcategory_id');

                    if(!empty($category_id))
                    {
                        $return = $return->where('products.category_id','=',$category_id);
                    }
                    if(!empty($subcategory_id))
                    {
                        $return = $return->where('products.subcategory_id','=', $subcategory_id);
                    }

                    $return = $return->where('products.is_delete','=', 0)
                    ->where('products.status','=', 0)
                    ->orderBy('products.id','desc')
                    ->paginate(1);

                    return $return;
    }

    static public function checkSlug($slug)
    {
        return self::where('slug','=',$slug)->count();
    }

    public function getColor()
    {
        return $this->hasMany(ProductColor::class, "product_id");
    }
    public function getSize()
    {
        return $this->hasMany(ProductSize::class, "product_id");
    }
    public function getimage()
    {
        return $this->hasMany(ProductImage::class, "product_id")->orderBy('order_by','asc');
    }
   static public function getSingleimage($product_id)
    {
       return ProductImage::where('product_id','=',$product_id)->orderBy('order_by','asc')->first();
    }
}
