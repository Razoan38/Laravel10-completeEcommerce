<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Str;



class AuthController extends Controller
{ 
    public function login()
    {
       if(!empty (Auth::check()) && Auth::user()->is_admin == 1) 
       {
        return redirect('admin/dashboard');
       }
        return view('admin.auth.login');
    }
    
    public function auth_login_admin(Request $request)
    {
    $remember = !empty($request->remember) ? true : false ;
    if(Auth::attempt(['email'=>$request->email, 'password' =>$request->password, 'is_admin' =>1 ,'status' =>0 ,'is_delete' =>0 ], $remember))
    {
         return redirect('admin/dashboard');
    }
    else {
        return redirect()->back()->with('error', "Please Enter currect Email And Password");
    }
       
    }

    public function logout_admin()
    {
          Auth::logout();
          return redirect(url(''));
    }

    // public function auth_register(Request $request)
    // {
     
    //     $checkEmail = User::CheckEmail($request->email);
    //      if(!empty($checkEmail))
    //      {
    //          $save =new User();
    //          $save->name = trim($request->name);
    //          $save->email = trim($request->email);
    //          $save->password = Hash::make($request->password);
    //          $save->save();

    //           $json['status'] = true;
    //           $json['message'] = "Your Account Successfully Created ";
    //      }
    //      else
    //       {
    //           $json['status'] = false;
    //           $json['message'] = "This Email Already Register ! Please Choose Another Email ";
    //       }
    //       echo json_encode($json);
        
    // }
    
    public function auth_login(Request $request)
    {   
         $remember = !empty($request->is_remember) ? true : false ;
         if(Auth::attempt(['email'=>$request->email, 'password' =>$request->password ,'status' =>0 ,'is_delete' =>0 ], $remember))
            {
                if(!empty(Auth::user()->email_verified_at))
                {
                    $json['status'] = true;
                    $json['message'] = "success";
                }
                else
                {
                    $save = User::getSingle(Auth::user()->id);
                    Mail::to($save->email)->send(new RegisterMail($save));
                     Auth::logout();
                    $json['status'] = false;
                    $json['message'] = "Your  account is not verified !. Please Check your inbox and verified ";
                }
           
                // $json['message'] = "Your Account Successfully Login ";
            }
            else 
            {
                $json['status'] = false;
                $json['message'] = "Please Enter currect Email And Password !";
               
            }
            echo json_encode($json);
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::CheckEmail($request->email);
        if(empty($checkEmail))
        {
            $save = new User();
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

           Mail::to($save->email)->send(new RegisterMail($save));

            $json['status'] = true;
            $json['message'] = "Your Account Successfully Created ! . Please verify Your Email Address ";
        }
        else
        {
            $json['status'] = false;
            $json['message'] = "This Email Already Registered! Please Choose Another Email";
        }
        // return response()->json($json);
        echo json_encode($json);
    }

    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user =User::getSingle($id);
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();

        return redirect(url(''))->with('success', "Email Successfully verified ");
    }

    public function forgot_password(Request $request)
    {

        $data['meta_title'] = 'Forgot Password';
      return view('website.auth.forgotPassword',$data);
    }

    public function auth_forgot_password(Request $request)
    {
       $user = User::where('email','=', $request->email)->first();
       if(!empty($user))
       {
         $user->remember_token = Str::random(30);
         $user->save();

        //  Mail::to($user->email)->send(new ForgotPasswordMail($user));
         Mail::to($user->email)->send(new ForgotPasswordMail($user));
         return redirect()->back()->with('success' , "Please Check your email and reset your password");

       }
       else
       {
        return redirect()->back()->with('error' , "Email not found in the system.");
       }
    }

    public function reset($token)
    {
        // return view('website.auth.reset');
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user))
        {
            $data['meta_title'] = 'Reset Password';
            $data['user'] = $user;
            return view('website.auth.reset',$data);
        }
        else
        {
            abort(404);
        }
    }

    // public function auth_reset($token, Request $request )
    // {
    //   if($request->password == $request->password)
    //   {
    //     $user = User::where('remember_token', '=', $token)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->remember_token = Str::random(30);
    //     $user->save();

    //     return redirect(url(''))->with('success' , "Password Successfully reset");
    //   }
    //   else
    //   {
    //     return redirect()->back()->with('error' , "Password and Confrim Password does not match. ");
    //   }
    // }


    public function auth_reset($token, Request $request)
    {
        if($request->password == $request->password)
        {
            $user = User::where('remember_token', '=', $token)->first();
            if($user)
            {
                $user->password = Hash::make($request->password);
                // $user->cpassword = Hash::make($request->cpassword);
                $user->remember_token = Str::random(30);
                $user->email_verified_at = date("Y-m-d H:i:s");
                $user->save();

                return redirect(url(''))->with('success', "Password Successfully reset");
            }
            
        }
        else
        {
            return redirect()->back()->with('error', "Password and Confirm Password does not match.");
        }
    }
}
