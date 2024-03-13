<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request ;

class Product extends Model
{
    use HasFactory;
    protected $table='products';

     public static function getSingle($id)
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

                    if(!empty (Request::get('subcategory_id')))
                    { 
                        $subcategory_id = rtrim(Request::get('subcategory_id'),',') ;
                        $subcategory_id_array = explode(",", $subcategory_id);
                        $return = $return->whereIn('products.subcategory_id', $subcategory_id_array);
                    }
                    else 
                    {
                        if(!empty(Request::get('old_category_id')))
                        {
                            $return = $return->where('products.category_id','=',
                            (Request::get('old_category_id')));
                        }
                        if(!empty(Request::get('old_subcategory_id')))
                        {
                            $return = $return->where('products.subcategory_id','=',
                             (Request::get('old_subcategory_id')));
                        }

                    }

                    if(!empty (Request::get('color_id')))
                    { 
                        $color_id = rtrim(Request::get('color_id'),',') ;
                        $color_id_array = explode(",", $color_id);
                        $return = $return->join('product_colors','product_colors.product_id','=','products.id');
                        $return = $return->whereIn('product_colors.color_id', $color_id_array);
                    }
                    if(!empty (Request::get('brand_id')))
                    { 
                        $brand_id = rtrim(Request::get('brand_id'),',') ;
                        $brand_id_array = explode(",", $brand_id);
                        $return = $return->join('product_colors','product_colors.product_id','=','products.id');
                        $return = $return->whereIn('products.brand_id', $brand_id_array);
                    }

                    if(!empty (Request::get('start_price')) && !empty (Request::get('end_price')))
                    {
                        $start_price = str_replace('$','', Request::get('start_price'));
                        $end_price = str_replace('$','', Request::get('end_price'));
                        $return = $return->where('products.price','>=',$start_price );
                        $return = $return->where('products.price','<=',$end_price );
                    }

                     if(!empty(Request::get('q')))
                      {
                        $return = $return->where('products.title','like', '%'.Request::get('q').'%');
                      }

                    $return = $return->where('products.is_delete','=', 0)
                    ->where('products.status','=', 0)
                    ->groupBy('products.id')
                    ->orderBy('products.id','desc')
                    ->paginate(6);

                    return $return;
    }

    static public function getRelatedProduct($product_id, $subcategory_id)
     {
        $return = Product::select('products.*', 'users.name as created_by_name','categories.category_name as category_name',
        'categories.category_slug as category_slug' ,'sub_categories.subcategory_name as sub_category_name',
        'sub_categories.subcategory_slug as sub_category_slug')
                    ->join('users','users.id','=','products.created_by')
                    ->join('categories','categories.id','=','products.category_id')
                    ->join('sub_categories','sub_categories.id','=','products.subcategory_id')
                    ->where('products.id','!=', $product_id)
                    ->where('products.subcategory_id','=', $subcategory_id)
                    ->where('products.is_delete','=', 0)
                    ->where('products.status','=', 0)
                    ->groupBy('products.id')
                    ->orderBy('products.id','desc')
                    ->limit(10)
                    ->get();

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
    //font-end desigen 
   static public function getSingleslug($slug)
    {
        return self::where('slug','=',$slug)
        ->where('products.is_delete','=', 0)
        ->where('products.status','=', 0)
        ->first();
    }

    public function getCategory()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function getSubCategory()
    {
        return $this->belongsTo(SubCategories::class,'subcategory_id');
    }
}
