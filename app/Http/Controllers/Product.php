<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Product extends Controller
{
    public function all()
    {
        $data = DB::table('tbl_product')
            ->leftJoin('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.id')
            ->leftJoin('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.id')
            ->select('tbl_product.*', 'tbl_category_product.category_name', 'tbl_brand.brand_name')
            ->get();
        return view('admin.allProduct', ['data' => $data]);
    }

    public function add()
    {
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        return view('admin.addProduct', ['cate' => $cate, 'brand' => $brand]);
    }

    public function listBySearch()
    {
        $data = DB::table('tbl_product')
        ->leftJoin('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.id')
        ->leftJoin('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.id')
        ->select('tbl_product.*', 'tbl_category_product.category_name', 'tbl_brand.brand_name')
        ->where('product_name', 'LIKE', "%{$_GET['name']}%")
        ->get();
        return view('admin.allProduct', ['data' => $data]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = DB::table('tbl_product')->where('id', $id)->first();
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        return view('admin.updateProduct', ['cate' => $cate, 'brand' => $brand, 'data' => $data]);
    }

    public function submit(Request $req)
    {
        $name = $req->name;
        $category = $req->category;
        $brand = $req->brand;
        $content = $req->content;
        $desc = $req->desc;
        $price = $req->price;
        $size = $req->size;
        $status = $req->status;
        $image = $req->file('image');

        if ($image) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('backend/images'), $imageName);
        }

        $result = DB::table('tbl_product')->insert(
            [
                'product_name' => $name,
                'category_id' => $category,
                'brand_id' => $brand,
                'desc' => $desc,
                'content' => $content,
                'price' => $price,
                'size' => $size,
                'status' => $status,
                'image' => isset($image) ? $imageName : null,
            ]
        );

        if ($result) {
            return Redirect::to('/admin/all-product');
        }

        // request()->validate([

        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        // ]);

        // $imageName = time() . '.' . request()->image->getClientOriginalExtension();

        // request()->image->move(public_path('backend/images'), $imageName);

        // return back()

        //     ->with('success', 'You have successfully upload image.')

        //     ->with('image', $imageName);

    }

    public function submitUpdate(Request $req, $id)
    {
        // $name = $req->name;
        // $desc = $req->desc;
        // $result = DB::table('tbl_product')
        //     ->where('id', $id)
        //     ->update(['name' => $name, 'desc' => $desc]);
        $name = $req->name;
        $category = $req->category;
        $brand = $req->brand;
        $content = $req->content;
        $desc = $req->desc;
        $price = $req->price;
        $size = $req->size;
        $status = $req->status;
        $image = $req->file('image');

        $data = [
            'product_name' => $name,
            'category_id' => $category,
            'brand_id' => $brand,
            'desc' => $desc,
            'content' => $content,
            'price' => $price,
            'size' => $size,
            'status' => $status,
        ];

        if ($image) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('backend/images'), $imageName);
            $data['image'] = $imageName;
        }
        $result = DB::table('tbl_product')->where('id', $id)->update($data);

        return Redirect::to('/admin/all-product');
    }

    public function delete(Request $req, $id)
    {
        $result = DB::table('tbl_product')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-product');
        }
    }
}
