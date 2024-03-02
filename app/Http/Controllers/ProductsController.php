<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\color;
use App\Models\Product;
use App\Models\SubCategories;

class ProductsController extends Controller
{
     public function getCategory($category_slug,$subcategory_slug ='')
     {
        $getCategory= Categories::getSingleslug($category_slug);
        $getSubCategory= SubCategories::getSingleslug($subcategory_slug);
        $data['getColor'] = color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        if(!empty($getCategory) && !empty($getSubCategory))
        {
            $data['meta_title']       = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords']    = $getSubCategory->meta_keywords;

            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;

            $data['getProduct'] = Product::getProduct($getCategory->id, $getSubCategory->id);
            $data['getSubCategoryFilter'] = SubCategories::getRecordSubCategory($getCategory->id);

            return view('website.product.list',$data);
        }
        if(!empty($getCategory))
        {
            $data['getCategory'] = $getCategory;

            $data['getSubCategoryFilter'] = SubCategories::getRecordSubCategory($getCategory->id);
       
        
            $data['meta_title']       = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords']    = $getCategory->meta_keywords;
            $data['getProduct'] = Product::getProduct($getCategory->id);
            return view('website.product.list',$data);
        }
        else{
            abort(404);
        }
     }

     public function getFilterProductAjax(Request $request)
     {
          dd($request->all());
     }
}
