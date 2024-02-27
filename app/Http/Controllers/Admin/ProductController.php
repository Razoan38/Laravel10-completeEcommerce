<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\color;
use App\Models\Product;
use App\Models\SubCategories;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
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

            ProductSize::deleteRecord($product->id);
            if(!empty($request->size))
            {
                foreach($request->size as $size) 
                {
                  if(!empty($size['name']))
                  {
                    $saveSize = new ProductSize;
                    $saveSize->name  = $size['name'];
                    $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
                    $saveSize->product_id = $product_id;
                    $saveSize->save();
                  }
                
                }
            }
            
           if(!empty($request->file('image')))
           {
              foreach($request->file('image') as $value)
              {
                  if($value->isValid())
                  {
                   $ext =$value->getClientOriginalExtension();
                   $randomStr = $product->id.Str::random(20);
                   $filename =strtolower($randomStr).'.'.$ext;
                   $value->move('upload/product/',$filename);
                    
                   $imageuplode = new ProductImage;
                   $imageuplode->image_name = $filename;
                   $imageuplode->image_extension = $ext;
                   $imageuplode->product_id = $product_id;
                   $imageuplode->save();
                  }
              }

           }
           

            return redirect()->back()->with('success',"Product Successfully Update");
        }
        else {
            abort(404);
        }

    }

    public function image_delate($id)
    {
        $image = ProductImage::getSingle($id);
        if(!empty($image->getimageshow()))
        {
              unlink('upload/product/'.$image->image_name);
        }
        $image->delete();

        return redirect()->back()->with('success',"Product Image Successfully Deleted"); 
    }

    public function product_sortable_image(Request $request)
    {
        if(!empty($request->photo_id))
        {
            $i =1;
            foreach($request->photo_id as $photo_id)
            {
                $image  = ProductImage::getSingle($photo_id);
                $image->order_by =$i;
                $image->save();

                $i++;
            }
        }

        $json['success'] =true;
        echo json_encode($json);
    }
}
