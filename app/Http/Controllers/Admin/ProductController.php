<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function list()
    {
        $data['getRecord'] =Product::getRecord();
        return view('admin.product.list',$data);
    }
    public function add()
    {
     
        return view('admin.product.add');
    }

    public function insert(Request $request)
    { 
        $title = trim($request->title);
       $product = new Product();
       $product->title = $title;
       $product->created_by = Auth::user()->id;
       $product->save();

       $slug = Str::slug($title, "_");

       $checkSlug =Product::checkSlug($slug);

       if(empty($checkSlug))
       {
        $product->slug = $slug;
        $product->save();
       }
       else
        {
            $new_slug = $slug.'_'.$product->id;
            $product->slug = $new_slug;
            $product->save();

        }
         return redirect('admin/product/edit/'.$product->id);
    }

    public function edit($product_id)
    {
        $product = Product::getSingle($product_id);
        if(!empty($product))
        {
            $data['getCategory'] =Categories::getRecordActive();
            $data['getBrand'] =Brand::getRecordActive();
            $data['getColor'] =color::getRecordActive();
            $data['product'] = $product;
            return view('admin.product.edit',$data);
        }
    }
}
