<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Categories extends Model
{
    use HasFactory;
    protected $table='categories';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getSingleslug($category_slug)
    {
        return self::where('category_slug', '=', $category_slug)
        ->where('categories.status','=', 0)
        ->where('categories.is_delete','=', 0)
        ->first();
    }

    static public function getRecord()
    {
        return self::select('categories.*', 'users.name as created_by_name')
        ->join('users','users.id','=', 'categories.created_by')
        ->where('categories.is_delete','=', 0)
        ->orderBy('categories.id','desc')
        ->get();
    }
    static public function getRecordActive()
    {
        return self::select('categories.*', 'users.name as created_by_name')
        ->join('users','users.id','=', 'categories.created_by')
        ->where('categories.is_delete','=', 0)
        ->where('categories.status','=', 0)
        ->orderBy('categories.category_name','asc')
        ->get();
    }
    static public function getRecordMenu()
    {
        return self::select('categories.*')
        ->join('users','users.id','=', 'categories.created_by')
        ->where('categories.is_delete','=', 0)
        ->where('categories.status','=', 0)
        ->get();
    }

    public function getSubCategory()
    {
        return $this->hasMany(SubCategories::class, "category_id")
        ->where('sub_categories.status','=', 0)
        ->where('sub_categories.is_delete','=', 0);
    }
   
    
    // public static function deletecategory($id)
    // {
    //  $categories =Categories::find($id);
    //  $categories->delete();
    // }

    // public static function deletecategory($id)
    // {
    //     // Find the record by ID and delete it
    //     $categories =Categories::find($id);
    //     return self::destroy($id);
    // }
}

