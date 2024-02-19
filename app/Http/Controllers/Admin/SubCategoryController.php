<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\SubCategories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] =SubCategories::getRecord();
        return view('admin.subcategory.list',$data);
    }

    public function add()
    { 
        $data['getCategory'] =Categories::getRecord();
        return view('admin.subcategory.add',$data);
    }
    public function insert(Request $request)
    {
     
        request()->validate([
                'subcategory_slug'=>'required|unique:sub_categories'
        ]); 
        // subcategories

        $subcategory = new SubCategories();
        $subcategory->category_id = trim($request->category_id);
        $subcategory->subcategory_name = trim($request->subcategory_name);
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name, '-');
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

    //    dd($category->all());
       return redirect('admin/sub_category/list')->with('success',"Sub Category Successfully Created");
    }

    
    public function edit($id)
    {  
        $data['getCategory'] =Categories::getRecord();
        $data['getRecord'] =SubCategories::getSingle($id); 
        return view('admin.subcategory.edit',$data);

    }

    public function update(Request $request, $id)
    {
        // request()->validate([
        //         'subcategory_slug'=>'required|unique:sub_categories'
        // ]); 
        // subcategories
        request()->validate([
            'subcategory_slug'=>'required|unique:sub_categories,subcategory_slug,'.$id
             ]);
        $subcategory = new SubCategories();
        $subcategory->category_id = trim($request->category_id);
        $subcategory->subcategory_name = trim($request->subcategory_name);
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name, '-');
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        //    dd($category->all());
         return redirect('admin/sub_category/list')->with('success',"Sub Category Successfully Update");
     }

     public function delate($id)
     {
        SubCategories::destroy($id);
         return redirect()->route('admin.sub_category.list')->with('success',"Sub Category Successfully Delete");
     }
     
    //  public function get_sub_category(Request $request)
    //  {
    //      $category_id = $request->id;  
    //      $get_sub_category = SubCategories::getRecordSubCategory($category_id);

    //      $html ='';
    //      $html ='<option value="">Select</option>';
    //      foreach($get_sub_category as $value)
    //      {
    //         $html = '<option value="'.$value->id.'">'.$value->subcategory_name.'</option>';

    //         $json['html'] = $html;
    //         echo json_encode($json);
    //      }
    //   }

          public function get_sub_category(Request $request)
            {
                $category_id = $request->id;  
                $get_sub_category = SubCategories::getRecordSubCategory($category_id);

                $html = '<option value="">Select</option>';

                foreach ($get_sub_category as $value) {
                    $html .= '<option value="' . $value->id . '">' . $value->subcategory_name . '</option>';
                }

                $json['html'] = $html;
                echo json_encode($json);
            }

}
