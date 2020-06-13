<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class News extends Controller
{
    public function all()
    {
        $data = DB::table('tbl_news')->get();
        return view('admin.allNews', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.addNews');
    }

    public function listBySearch() {
        $data = DB::table('tbl_news')->where('news_name','LIKE', "%{$_GET['name']}%")->get();
        return view('admin.allNews', ['data' => $data]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = DB::table('tbl_news')->where('id', $id)->first();
        return view('admin.updateNews', ['data' => $data]);
    }

    public function submit(Request $req)
    {
        
        $name = $req->name;
        $content = $req->content;
        $desc = $req->desc;
        $image = $req->file('image');
        if ($image) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('backend/images'), $imageName);
        }

        $result = DB::table('tbl_news')->insert(
            [
                'news_name' => $name,
                'desc' => $desc,
                'content' => $content,
                'image' => isset($image) ? $imageName : null,
            ]
        );
        if ($result) {
            return Redirect::to('/admin/all-news');
        }
    }

    public function submitUpdate(Request $req, $id)
    {
        $name = $req->name;
        $content = $req->content;
        $desc = $req->desc;
        $image = $req->file('image');

        $data = [
            'news_name' => $name,
            'desc' => $desc,
            'content' => $content,
        ];

        if ($image) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('backend/images'), $imageName);
            $data['image'] = $imageName;
        }

        $result = DB::table('tbl_news')->where('id', $id)->update($data);
        return Redirect::to('/admin/all-news');
       
    }

    public function delete(Request $req, $id) {
        $result = DB::table('tbl_news')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-news');
        }
    }

    public function allNews()
    {
        $data = DB::table('tbl_news')->get();
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        return view('website.listNews', ['cate' => $cate, 'brand' => $brand, 'data' => $data]);
        // return view('website.allNews', ['data' => $data]);
    }

    public function detailNews(Request $req, $id)
    {   
        $brand = DB::table('tbl_brand')->get();
        $cate = DB::table('tbl_category_product')->get();
        $data = DB::table('tbl_news')->where('id', $id)->first();
        return view('website.detailNews', ['cate' => $cate, 'brand' => $brand, 'data' => $data]);
    }

}
