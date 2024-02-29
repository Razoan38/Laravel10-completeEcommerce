<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    protected $table='sub_categories';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleslug($subcategory_slug)
    {
        return self::where('subcategory_slug', '=', $subcategory_slug)
        ->where('sub_categories.status','=', 0)
        ->where('sub_categories.is_delete','=', 0)
        ->first();
    }

    public static function getRecord()
    {
        return self::select('sub_categories.*', 'users.name as created_by_name', 'categories.category_name as category_name')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->orderBy('sub_categories.id', 'desc')
            ->paginate(20);
    }
    public static function getRecordSubCategory($category_id)
    {
        return self::select('sub_categories.*')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->where('sub_categories.status', '=', 0)
            ->where('sub_categories.category_id', '=', $category_id)
            ->orderBy('sub_categories.subcategory_name', 'asc')
            ->get();
    }

    public function TotalProduct()
    {
        return $this->hasMany(Product::class, "subcategory_id")
        ->where('products.is_delete','=', 0)
        ->where('products.status','=', 0)
        ->count();

    }
}
