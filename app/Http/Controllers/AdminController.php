<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');

    }
    
    public function logout(Request $request){
        
        $request->session()->invalidate();

        return redirect()->route('login');
    }

}
