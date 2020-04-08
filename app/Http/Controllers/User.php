<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class User extends Controller
{
    public function all()
    {
        $data = DB::table('tbl_admin')->get();
        return view('admin.allUser', ['data' => $data]);
    }

    public function add()
    {

        return view('admin.addUser');
    }

    public function listBySearch()
    {
        $data = DB::table('tbl_admin')->where('name', 'LIKE', "%{$_GET['name']}%")->get();
        return view('admin.allUser', ['data' => $data]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = DB::table('tbl_admin')->where('id', $id)->first();
        return view('admin.updateUser', ['data' => $data]);
    }

    public function submit(Request $req)
    {
        $data = [];
        $data['email'] = $req->email;
        $data['name'] = $req->name;
        $data['phone'] = $req->phone;
        $data['password'] = $req->password;
        $data['level'] = $req->level;
        $emails = DB::table('tbl_admin')->select('email')->get();
        $emails = DB::table('tbl_admin')->select('email')->get();
        $custom_email = [];
        foreach ($emails as $key => $value) {
            array_push($custom_email, $value->email);
        }
        if (in_array($req->email, $custom_email)) {
            Session::put('error', 'Email already exists!');
            return Redirect::to('/admin/add-user');
        } else {
            $result = DB::table('tbl_admin')->insert($data);
            Session::put('error', null);
            return Redirect::to('/admin/add-user');
        }

        // if ($result) {
        // return Redirect::to('/admin/all-user');
        // }
    }

    public function submitUpdate(Request $req, $id)
    {
        $data = [];
        $data['email'] = $req->email;
        $data['name'] = $req->name;
        $data['phone'] = $req->phone;
        $data['level'] = $req->level;

        DB::table('tbl_admin')
            ->where('id', $id)
            ->update($data);
        return Redirect::to('/admin/all-user');
    }

    public function delete(Request $req, $id)
    {
        $result = DB::table('tbl_admin')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-user');
        }
    }
}
