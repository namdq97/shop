<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Review extends Controller
{
    public function submit(Request $req, $id){
        $data = [];
        $data['content'] = $req->content;
        $data['product_id'] = $id;
        $data['user_id'] = Auth::id();
        $result = DB::table('tbl_review')->insert($data);
        if ($result) {
            return Redirect::to('chi-tiet-san-pham/'.$id);
        }
    }

    public function all()
    {
        $data = DB::table('tbl_review')
            ->leftJoin('tbl_product', 'tbl_review.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_review.user_id', '=', 'users.id')
            ->select('tbl_review.*', 'tbl_product.product_name', 'users.name')
            ->get();
        return view('admin.allReview', ['data' => $data]);
    }

    public function delete(Request $req, $id)
    {
        $result = DB::table('tbl_review')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-review');
        }
    }

}
