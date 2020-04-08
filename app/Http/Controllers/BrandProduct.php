<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandProduct extends Controller
{
    public function all()
    {
        $data = DB::table('tbl_brand')->get();
        return view('admin.allBrandProduct', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.addBrandProduct');
    }

    public function listBySearch() {
        $data = DB::table('tbl_brand')->where('brand_name','LIKE', "%{$_GET['name']}%")->get();
        return view('admin.allBrandProduct', ['data' => $data]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = DB::table('tbl_brand')->where('id', $id)->first();
        return view('admin.updateBrandProduct', ['data' => $data]);
    }

    public function submit(Request $req)
    {
        $name = $req->name;
        $desc = $req->desc;
        $result = DB::table('tbl_brand')->insert(
            ['brand_name' => $name, 'desc' => $desc]
        );
        if ($result) {
            return Redirect::to('/admin/all-brand-product');
        }
    }

    public function submitUpdate(Request $req, $id)
    {
        $name = $req->name;
        $desc = $req->desc;
        $result = DB::table('tbl_brand')
            ->where('id', $id)
            ->update(['brand_name' => $name, 'desc' => $desc]);
            return Redirect::to('/admin/all-brand-product');
    }

    public function delete(Request $req, $id) {
        $result = DB::table('tbl_brand')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-brand-product');
        }
    }
}
