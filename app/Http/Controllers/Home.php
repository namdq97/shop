<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Home extends Controller
{
    //
    public function index(){
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        $all = DB::table('tbl_product')->orderby('id', 'desc')->limit(3)->get();
        $alls = DB::table('tbl_product')->orderby('id', 'desc')->get();
        return view('website.home', ['cate' => $cate, 'brand' => $brand, 'all' => $all, 'alls' => $alls]);
    }
}
