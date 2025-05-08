<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\admin\admin;

class adminAuth extends Controller
{
    public function index(){
        return view('auth.adminLogin');
    }

    public function login(Request $request){
        admin::create([
            'username' => 'admin@vividblock',
            'firstname' => 'Admin',
            'lastname' => 'VividBlock',
            'email' => 'admin@vividblock.com',
            'password'=> Hash::make('password123'),
            'admin_type'=> 1,
            'admin_status' => 1
        ]);

        // $rules = [
        //     'username' => 'required|string|max:255',
        //     'password' => 'required|string|min:8'
        // ];

        // $message = [
        //     'username.required' => 'username is required.',
        //     'username.string' => 'username must be valid.',
        //     'username.max' => 'username may not be greater than 255 characters.',
        //     'password.required' => 'password is required.',
        //     'password.string' => 'password must be valid.',
        //     'password.min' => 'password must be at least 8 characters long.',
        // ];

        // $validator = Validator::make($request->all(), $rules, $message);

        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // $admin = admin::where('username', $request->username)->orWhere('email',$request->username)->first();

        // if(!$admin){
        //     return redirect()->back()->withErrors(['username'=>'Invalid username or email.'])->withInput();
        // }

        // if(!Hash::check($request->password, $admin->password)){
        //     return redirect()->back()->withErrors(['password'=>'Incorrect password.'])->withInput();
        // }

        // if($admin->admin_status == 0){
        //     return redirect()->back()->withErrors(['username' => 'Account deactivated. Contact Superadmin.'])->withInput();
        // }

        // Session::put('adminlogin', true);
        // Session::put('admin_id', $admin->id);
        // Session::put('admin_username', $admin->username);
        // Session::put('admin_firstname', $admin->firstname);
        // Session::put('admin_email', $admin->email);
        // Session::put('admin_type', $admin->admin_type);

        // return redirect()->route('adminDashboardView');

    }
}
