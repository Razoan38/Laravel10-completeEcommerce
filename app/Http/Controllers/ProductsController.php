<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\color;
use App\Models\Product;
use App\Models\SubCategories;
use App\Mail\OrderInvoiceMail;
use Illuminate\Support\Facades\Mail;

class ProductsController extends Controller
{
    
    public function getProductSearch(Request $request)
    {
       $data['meta_title']       = 'Search';
       $data['meta_description'] = '';
       $data['meta_keywords']    = '';

       $getProduct = Product::getProduct();
       
       $page = 0;
       if(!empty($getProduct->nextPageUrl())) 
       {
           $parse_url = parse_url($getProduct->nextPageUrl());
         
           if(!empty($parse_url['query']))
           {
               parse_str($parse_url['query'], $get_array);
               $page = !empty($get_array['page']) ? $get_array['page'] : 0;
           }
       }
       $data['page'] = $page;
       $data['getProduct'] = $getProduct;
       $data['getColor'] = color::getRecordActive();
       $data['getBrand'] = Brand::getRecordActive();

       return view('website.product.list', $data);
    }

     public function getCategory($category_slug, $subcategory_slug ='')
     {

        $getProductsingle= Product::getSingleslug($category_slug);
        $getCategory= Categories::getSingleslug($category_slug);
        $getSubCategory= SubCategories::getSingleslug($subcategory_slug);

        $data['getColor'] = color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        if(!empty($getProductsingle))
        {
            $data['meta_title']       = $getProductsingle->title;
            $data['meta_description'] = $getProductsingle->short_description;
            
            $data['getProduct'] = $getProductsingle;
            $data['getRelatedProduct'] = Product::getRelatedProduct($getProductsingle->id, 
            $getProductsingle->subcategory_id,);

            return view('website.product.detail',$data);
        }
        else if (!empty($getCategory) && !empty($getSubCategory))
        {
            $data['meta_title']       = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords']    = $getSubCategory->meta_keywords;

            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;

              $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);
              $page = 0;
                if(!empty($getProduct->nextPageUrl())) 
                {
                    $parse_url = parse_url($getProduct->nextPageUrl());
                
                    if(!empty($parse_url['query']))
                    {
                        parse_str($parse_url['query'], $get_array);
                        $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                    }
                }
              $data['page'] = $page;
              $data['getProduct'] = $getProduct;

            $data['getSubCategoryFilter'] = SubCategories::getRecordSubCategory($getCategory->id);

            return view('website.product.list',$data);
        }
        else if(!empty($getCategory))
        {
         

            $data['getSubCategoryFilter'] = SubCategories::getRecordSubCategory($getCategory->id);
            $data['getCategory'] = $getCategory;
        
            $data['meta_title']       = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords']    = $getCategory->meta_keywords;

            $getProduct = Product::getProduct($getCategory->id);
            
            $page = 0;
            if(!empty($getProduct->nextPageUrl())) 
            {
                $parse_url = parse_url($getProduct->nextPageUrl());
              
                if(!empty($parse_url['query']))
                {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;
            $data['getProduct'] = $getProduct;

            return view('website.product.list',$data);
        }
        else{
            abort(404);
        }
     }

     public function getFilterProductAjax(Request $request)
     {
        $getProduct = Product::getProduct();
        
        $page = 0;
            if(!empty($getProduct->nextPageUrl())) 
            {
                $parse_url = parse_url($getProduct->nextPageUrl());
              
                if(!empty($parse_url['query']))
                {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            // $data['page'] = $page;
        return response()->json([
         "status"  =>true,
         "page"  =>$page,
         "success"  =>view("website.product.allProduct",[
            "getProduct"  =>$getProduct,
         ])->render(),
        ],200);
     }

     
}



