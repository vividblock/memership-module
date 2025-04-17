<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class logoutController extends Controller
{
    public function logout(){
        Session::flush();
        return redirect()->route('adminLoginView');
    }
}
