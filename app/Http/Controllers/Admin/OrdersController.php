<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;

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
}
