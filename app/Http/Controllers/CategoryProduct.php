<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryProduct extends Controller
{
    public function all()
    {
        $data = DB::table('tbl_category_product')->get();
        return view('admin.allCategoryProduct', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.addCategoryProduct');
    }

    public function listBySearch() {
        $data = DB::table('tbl_category_product')->where('name','LIKE', "%{$_GET['name']}%")->get();
        return view('admin.allCategoryProduct', ['data' => $data]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = DB::table('tbl_category_product')->where('id', $id)->first();
        return view('admin.updateCategoryProduct', ['data' => $data]);
    }

    public function submit(Request $req)
    {
        $name = $req->name;
        $desc = $req->desc;
        $result = DB::table('tbl_category_product')->insert(
            ['name' => $name, 'desc' => $desc]
        );
        if ($result) {
            return Redirect::to('/admin/all-category-product');
        }
    }

    public function submitUpdate(Request $req, $id)
    {
        $name = $req->name;
        $desc = $req->desc;
        $result = DB::table('tbl_category_product')
            ->where('id', $id)
            ->update(['name' => $name, 'desc' => $desc]);
        if ($result) {
            return Redirect::to('/admin/all-category-product');
        }
    }
}
