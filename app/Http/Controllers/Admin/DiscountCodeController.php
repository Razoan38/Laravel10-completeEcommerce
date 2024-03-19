<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    public function list()
    {
        $data['getRecord'] =DiscountCode::getRecord();
        return view('admin.discountCode.list',$data);
    }

    public function add()
    {
        return view('admin.discountCode.add');
    }
    public function insert(Request $request)
    {
  
    // discountCode

       $discountCode = new DiscountCode();
       $discountCode->name = trim($request->name);
       $discountCode->type = trim($request->type);
       $discountCode->precent_amount = trim($request->precent_amount);
       $discountCode->expire_date = trim($request->expire_date);
       $discountCode->status = trim($request->status);
       $discountCode->save();

    //    dd($brands->all());
       return redirect('admin/discount_code/list')->with('success',"Discount Code Successfully Created");
    }

    public function edit($id)
    {  
        $data['getRecord'] =DiscountCode::getSingle($id); 
        return view('admin.discountCode.edit',$data);

    }

    public function update(Request $request, $id)
    {
   // discountCode
       
   $discountCode = DiscountCode::getSingle($id);
   $discountCode->name = trim($request->name);
   $discountCode->type = trim($request->type);
   $discountCode->precent_amount = trim($request->precent_amount);
   $discountCode->expire_date = trim($request->expire_date);
   $discountCode->status = trim($request->status);
   $discountCode->save();

      return redirect('admin/discount_code/list')->with('success',"Discount Code Successfully Update");
   }

   
    public function delate($id)
    {
        DiscountCode::destroy($id);
        return redirect()->route('admin.discount_code.list')->with('success'," Discount Code Successfully Delete");
    }
}
