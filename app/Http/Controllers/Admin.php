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
        $id = Session::get('id');
        if($id) {
            return view('admin.dashboard');
        } else {
            return view('admin.login');
        }
    }

    public function showDashboard()
    {
        $id = Session::get('id');
        if($id) {
            return view('admin.dashboard');
        } else {
            return view('admin.login');
        }
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
            Session::put('password', $result->password);
            Session::put('level', $result->level);
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
        Session::put('level', null);
        return Redirect::to('admin');

    }

    public function profile()
    {
        $id = Session::get('id');
        $data = DB::table('tbl_admin')->where('id', $id)->first();
        return view('admin.profile', ['data' => $data]);
    }

    public function changePassword()
    {
        return view('admin.changePassword');
    }

    public function updatePassword(Request $request) {
        $id = Session::get('id');
        $pass = Session::get('password');
        $data = [];
        $data['password'] = $request->new;
        if($pass !== $request->old) {
            Session::put('error', 'Password not match!');
            return view('admin.changePassword');
        } else {
            Session::put('error', null);
            $result = DB::table('tbl_admin')
                    ->where('id', $id)
                    ->update($data);
            return Redirect::to('admin');
        }
    }

    public function updateProfile(Request $request)
    {
        $id = Session::get('id');
        $level = Session::get('level');
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        if ($level === 1) {
            $data['level'] = $request->level;
        } else {
            $data['level'] = 0;
        }
        $result = DB::table('tbl_admin')
            ->where('id', $id)
            ->update($data);
        return Redirect::to('admin/profile');
    }

}
