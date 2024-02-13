<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] =Categories::getRecord();
        return view('admin.category.list',$data);
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function insert(Request $request)
    {
    //    

    request()->validate([
             'category_slug'=>'required|unique:categories'
    ]);
    // categories

       $category = new Categories();
       $category->category_name = trim($request->category_name);
       $category->category_slug = Str::slug($request->category_name, '-');
       $category->status = trim($request->status);
       $category->meta_title = trim($request->meta_title);
       $category->meta_description = trim($request->meta_description);
       $category->meta_keywords = trim($request->meta_keywords);
       $category->created_by = Auth::user()->id;
       $category->save();

    //    dd($category->all());
       return redirect('admin/category/list')->with('success',"Category Successfully Created");
    }

    public function edit($id)
    {  
        $data['getRecord'] =Categories::getSingle($id); 
        return view('admin.category.edit',$data);

    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'category_slug'=>'required|unique:categories,category_slug,'.$id
   ]);
   // categories
       
      $category = Categories::getSingle($id);
      $category->category_name = trim($request->category_name);
      $category->category_slug = Str::slug($request->category_name, '-');
      $category->status = trim($request->status);
      $category->meta_title = trim($request->meta_title);
      $category->meta_description = trim($request->meta_description);
      $category->meta_keywords = trim($request->meta_keywords);
      
      $category->save();

   //    dd($category->all());
      return redirect('admin/category/list')->with('success',"Category Successfully Update");
   }


    public function delate($id)
    {
        Categories::destroy($id);
        return redirect()->route('admin.category.list')->with('success',"Sub Category Successfully Delete");
    }

    
}
