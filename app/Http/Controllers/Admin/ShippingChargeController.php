<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function list()
    {
        $data['getRecord'] =ShippingCharge::getRecord();
        return view('admin.shippingCharge.list',$data);
    }

    public function add()
    {
        return view('admin.shippingCharge.add');
    }
    public function insert(Request $request)
    {
  
    // shippingCharge

       $shippingCharge = new ShippingCharge();
       $shippingCharge->name = trim($request->name);
       $shippingCharge->price = trim($request->price);
       $shippingCharge->status = trim($request->status);
       $shippingCharge->save();
       
    //    dd($brands->all());
       return redirect('admin/shipping_charge/list')->with('success'," Shipping Charge Successfully Created");
    }

    public function edit($id)
    {  
        $data['getRecord'] =ShippingCharge::getSingle($id); 
        return view('admin.shippingCharge.edit',$data);

    }

    public function update(Request $request, $id)
    {
   // shippingCharge
       
    $shippingCharge = ShippingCharge::getSingle($id);
    $shippingCharge->name = trim($request->name);
    $shippingCharge->price = trim($request->price);
    $shippingCharge->status = trim($request->status);
    $shippingCharge->save();

      return redirect('admin/shipping_charge/list')->with('success',"Shipping Charge Successfully Update");
   }

   
    public function delate($id)
    {
      $shippingCharge = ShippingCharge::getSingle($id);
      $shippingCharge->is_delete = 1;
      $shippingCharge->save();


        return redirect()->route('admin.shipping_charge.list')->with('success'," Shipping Charge Successfully Delete");
    }
    // public function delate($id)
    // {
    //     ShippingCharge::destroy($id);
    //     return redirect()->route('admin.shipping_charge.list')->with('success'," Shipping Charge Successfully Delete");
    // }
}
