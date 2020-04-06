<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();

class Admin extends Controller
{
    //
    public function index()
    {
        return view('admin.login');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $result = DB::table('tbl_admin')->where('email', $email)->where('password', $password)->first();
        if ($result) {
            // return view('admin/dashboard');
            Session::put('name', $result->name);
            Session::put('id', $result->id);
            return Redirect::to('admin/dashboard');
        } else {
            Session::put('msg', 'Email or password is not correct');
            return Redirect::to('admin');
        }
    }

    public function logout()
    {
        Session::put('name', null);
        Session::put('id', null);
        return Redirect::to('admin');

    }

}
