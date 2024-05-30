<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusMail;

class OrdersController extends Controller
{
    public function list()
    {
        $data['getRecord'] =order::getRecord();
        return view('admin.order.list',$data);
    }
    public function order_detail($id)
    {
        $data['getRecord'] =order::getSingle($id);
        return view('admin.order.detail',$data);
    }

    public function orders_status (Request $request)
    {
       $getOrder = order::getSingle($request->order_id);
       $getOrder->status = $request->status;
       $getOrder->save();
       
           Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));

       $json['message'] = "Status Update success";
       echo json_encode($json);
    }
}
