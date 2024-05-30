<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord']= User::getAdmin();
      
        return view('admin.admin.list',$data);
    }
    
    
    public function add()
    {
        return view('admin.admin.add');
    }
    public function insert(Request $request)
    {
        request()->validate([
            'email' =>'required|email|unique:users'
        ]);
        $user =new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password);
        $user->status=$request->status;
        $user->is_admin=1;
        $user->save();

        return redirect('admin/admin/list')->with('success',"admin Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord']= User::getSingle($id);
        return view('admin.admin.edit', $data);
    }

    public function update(Request $request ,$id)
    {
        $user = User::getSingle($id);
        $user->name=$request->name;
        $user->email=$request->email;
        if(!empty($request->password))
        {
            $user->password= $request->password;
        }
        $user->status=$request->status;
        $user->is_admin=1;
        $user->save();

        return redirect('admin/admin/list')->with('success',"admin Successfully Update");
    }

    public function delate($id)
    {
      $user = User::getSingle($id);
      $user->is_delete = 1;
      $user->save();

      return redirect()->back()->with('success'," Record  Successfully Delete");
    }


    public function customer_list()
    {
        $data['getRecord']= User::getCustomer();
      
        return view('admin.customer.list',$data);
    }
}
