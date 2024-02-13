<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function list()
    {
        $data['getRecord'] =Color::getRecord();
        return view('admin.color.list',$data);
    }

    public function add()
    {
        return view('admin.color.add');
    }
    public function insert(Request $request)
    {
  
    // color

       $color = new Color();
       $color->color_name = trim($request->color_name);
       $color->color_code = trim($request->color_code);
       $color->status = trim($request->status);
       $color->created_by = Auth::user()->id;
       $color->save();

    //    dd($brands->all());
       return redirect('admin/color/list')->with('success',"color Successfully Created");
    }

    public function edit($id)
    {  
        $data['getRecord'] =Color::getSingle($id); 
        return view('admin.color.edit',$data);

    }

    public function update(Request $request, $id)
    {
   // Brand
       
      $color = Color::getSingle($id);
      $color->color_name = trim($request->color_name);
      $color->color_code = trim($request->color_code);
      $color->status = trim($request->status);
      $color->created_by = Auth::user()->id;
      $color->save();
   //    dd($brands->all());
      return redirect('admin/color/list')->with('success',"color Successfully Update");
   }

   
    public function delate($id)
    {
        Color::destroy($id);
        return redirect()->route('admin.color.list')->with('success'," color Successfully Delete");
    }
}
