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

    public function listBySearch()
    {
        $data = DB::table('tbl_category_product')->where('category_name', 'LIKE', "%{$_GET['name']}%")->get();
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
            ['category_name' => $name, 'desc' => $desc]
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
            ->update(['category_name' => $name, 'desc' => $desc]);
        return Redirect::to('/admin/all-category-product');
    }

    public function delete(Request $req, $id)
    {
        $result = DB::table('tbl_category_product')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-category-product');
        }
    }

    //website
    public function show_list_product(Request $req)
    {
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        if (isset($_GET['category'])) {
            $cate_id = $_GET['category'];
            if (isset($_GET['search'])) {
                $all = DB::table('tbl_product')->orderby('id', 'desc')->where([['category_id', $cate_id], ['product_name', 'LIKE', "%{$_GET['search']}%"]])->get();
            } else {
                if (!isset($_GET['sort'])) {
                    $all = DB::table('tbl_product')->orderby('id', 'desc')->where('category_id', $cate_id)->get();
                } else {
                    $sort = $_GET['sort'];
                    $all = DB::table('tbl_product')->orderby('price', $sort)->where('category_id', $cate_id)->get();
                }
            }

        } else {
            $brand_id = $_GET['brand'];
            if (isset($_GET['search'])) {
                $all = DB::table('tbl_product')->orderby('id', 'desc')->where([['brand_id', $brand_id], ['product_name', 'LIKE', "%{$_GET['search']}%"]])->get();
            } else {
                if (!isset($_GET['sort'])) {
                    $all = DB::table('tbl_product')->orderby('id', 'desc')->where('brand_id', $brand_id)->get();
                } else {
                    $sort = $_GET['sort'];
                    $all = DB::table('tbl_product')->orderby('price', $sort)->where('brand_id', $brand_id)->get();
                }
            }
        }
        return view('website.listProduct', ['cate' => $cate, 'brand' => $brand, 'all' => $all]);
    }
}
