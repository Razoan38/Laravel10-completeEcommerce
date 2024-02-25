<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\color;
use App\Models\Product;
use App\Models\SubCategories;
use App\Models\ProductColor;
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

            $data['getSubCategory'] = SubCategories::getRecordSubCategory($product->category_id);

            return view('admin.product.edit',$data);
        }
    }

    public function update(Request $request, $product_id)
    {
        // dd($request->all());
        $product = Product::getSingle($product_id);
        if(!empty($product))
        {
            $product->title =trim($request->title);
            $product->slug =trim($request->slug);
            $product->sku =trim($request->sku);
            $product->category_id =trim($request->category_id);
            $product->subcategory_id =trim($request->subcategory_id);
            $product->brand_id =trim($request->brand_id);
            $product->price =trim($request->price);
            $product->old_price =trim($request->old_price);
            $product->short_description =trim($request->short_description);
            $product->description =trim($request->description);
            $product->additional_information =trim($request->additional_information);
            $product->shipping_returns =trim($request->shipping_returns);
            $product->status =trim($request->status);
            $product->save();

            ProductColor::deleteRecord($product->id);
            if(!empty($request->color_id))
            {
                foreach($request->color_id as $color_id) 
                {
                   $color = new ProductColor;
                   $color->color_id = $color_id;
                   $color->product_id = $product_id;
                   $color->save();
                }
            }

            return redirect()->back()->with('success',"Product Successfully Update");
        }
        else {
            abort(404);
        }

    }
}
