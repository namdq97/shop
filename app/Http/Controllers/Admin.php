<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Admin extends Controller
{
    //
    public function index(){
        return view('admin.login');
    }

    public function showDashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        $result = DB::table('tbl_admin')->where('email', $email)->where('password', $password)->first();
        if($result){
            return view('admin/dashboard');
        }
    }

    public function logout(){
        
    }

}
