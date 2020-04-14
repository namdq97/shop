<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Profile extends Controller
{
    //
    public function updateProfile(Request $request)
    {
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        $data = DB::table('users')->where('id', Auth::id())->first();
        return view('website.profile', ['cate' => $cate, 'brand' => $brand, 'data' => $data]);

    }

    public function submitUpdateProfile(Request $req)
    {
        $data = [];
        $data['email'] = $req->email;
        $data['name'] = $req->name;

        DB::table('users')
            ->where('id', Auth::id())
            ->update($data);
        return Redirect::to('/profile');
        // return view('website.profile', ['cate' => $cate, 'brand' => $brand]);
    }

    public function updatePassword(Request $request)
    {
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        return view('website.changePassword', ['cate' => $cate, 'brand' => $brand]);

    }

    protected function submitUpdatePassword(Request $request)
    {
        $data['password'] = Hash::make($request->new);
        $result = DB::table('users')
                    ->where('id', Auth::id())
                    ->update($data);
        // $request->validate([
        //     'old' => ['required', 'string', 'min:8'],
        //     'new' => ['required', 'string', 'min:8'],
        // ]);
    }
    


}
