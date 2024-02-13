<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function list()
    {
        $data['getRecord'] =Brand::getRecord();
        return view('admin.brand.list',$data);
    }

    public function add()
    {
        return view('admin.brand.add');
    }
    public function insert(Request $request)
    {
    //    

    request()->validate([
             'brand_slug'=>'required|unique:brands'
    ]);
    // categories

       $brands = new Brand();
       $brands->brand_name = trim($request->brand_name);
       $brands->brand_slug = Str::slug($request->brand_slug, '-');
       $brands->status = trim($request->status);
       $brands->meta_title = trim($request->meta_title);
       $brands->meta_description = trim($request->meta_description);
       $brands->meta_keywords = trim($request->meta_keywords);
       $brands->created_by = Auth::user()->id;
       $brands->save();

    //    dd($brands->all());
       return redirect('admin/brand/list')->with('success',"Brand Successfully Created");
    }

    public function edit($id)
    {  
        $data['getRecord'] =Brand::getSingle($id); 
        return view('admin.brand.edit',$data);

    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'brand_slug'=>'required|unique:brands,brand_slug,'.$id
   ]);
   // Brand
       
      $brands = Brand::getSingle($id);
      $brands->brand_name = trim($request->brand_name);
      $brands->brand_slug = Str::slug($request->brand_slug, '-');
      $brands->status = trim($request->status);
      $brands->meta_title = trim($request->meta_title);
      $brands->meta_description = trim($request->meta_description);
      $brands->meta_keywords = trim($request->meta_keywords);
      
      $brands->save();

   //    dd($brands->all());
      return redirect('admin/brand/list')->with('success',"Brand Successfully Update");
   }


    public function delate($id)
    {
        Brand::destroy($id);
        return redirect()->route('admin.brand.list')->with('success',"Brand Successfully Delete");
    }

}
