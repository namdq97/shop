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

    public function filter(Request $req)
    {
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        $data = DB::table('tbl_bill as b') ->leftJoin('tbl_product', 'b.product_id', '=', 'tbl_product.id')
        ->select('b.*', 'tbl_product.product_name')->whereDate('b.created_at','>=', $start_date)->whereDate('b.created_at','<=', $end_date)->get();
        return view('admin.allBill', ['data' => $data, 'start_date' => $start_date, 'end_date' => $end_date]);
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

    public function export(Request $req, $id)
    {
        $data = DB::table('tbl_bill as b') ->leftJoin('tbl_product', 'b.product_id', '=', 'tbl_product.id')
        ->select('b.*', 'tbl_product.product_name')->where('b.id', $id)->first();
        if($data) {
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=document_name.doc");    
            echo "<html>";
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
            echo "<body>";
            echo "<div>
                <h2>Hoa Don Mua Hang </h2>
                <p>Khach hang: " .$data->name. "</p>
                <p>San Pham: " .$data->product_name. "</p>
                <p>So Luong: " .$data->count. "</p>
                <p>Dia Chi: " .$data->address. "</p>
                <p>Thanh Tien: " .$data->price. " VND</p>
                <h3>Thank you!!</h3>
            </div>";
            echo "</body>";
            echo "</html>";
        }
        // return Redirect::to('/admin/all-bill');
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
