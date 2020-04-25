<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Bill extends Controller
{
    public function all()
    {
        $data = DB::table('tbl_bill') ->leftJoin('tbl_product', 'tbl_bill.product_id', '=', 'tbl_product.id')
        ->select('tbl_bill.*', 'tbl_product.product_name')->get();
        return view('admin.allBill', ['data' => $data]);
    }

    public function detail()
    {
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        $data = DB::table('tbl_bill') ->leftJoin('tbl_product', 'tbl_bill.product_id', '=', 'tbl_product.id')
        ->select('tbl_bill.*', 'tbl_product.product_name', 'tbl_product.price')->where('user_id', Auth::id())->get();
        return view('website.myBill', ['cate' => $cate, 'brand' => $brand, 'data' => $data]);
    }

    public function delete(Request $req, $id)
    {
        $result = DB::table('tbl_bill')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-bill');
        }
    }

    public function update(Request $req)
    {
        $data = [];
        $data['status'] = $_GET['stt'];

        DB::table('tbl_bill')
            ->where('id', $_GET['id'])
            ->update($data);
        return Redirect::to('/admin/all-bill');
    }

}
