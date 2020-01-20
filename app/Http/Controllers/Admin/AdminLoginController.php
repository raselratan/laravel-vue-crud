<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminLoginController extends Controller
{   

    public function __construct()
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function showForm(){
       return view('welcome');
    }

    public function login(Request $request){   
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:3'
        ]);
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)){
            return redirect()->intended(route('admin.dashboard'));
        }
        return ['logmsg'=>'error'];
        //return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function registration(Request $request){  
        $this->validate($request, [
            'name'=>'required|min:4|max:20',
            'email'=>'required|email',
            'password'=>'required|min:3'
        ]);

        return Admin::create([
            'name'     =>$request['name'],
            'email'    =>$request['email'],
            'password' =>Hash::make($request['password'])
        ]);
        

    }
}
