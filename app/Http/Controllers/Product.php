<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

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

    public function detailProduct(Request $req, $id)
    {
        $data = DB::table('tbl_product')->where('id', $id)->first();
        $review = DB::table('tbl_review')->leftJoin('users', 'tbl_review.user_id', '=', 'users.id')
            ->select('tbl_review.*', 'users.name')->where('product_id', $id)->get();
        $brand = DB::table('tbl_brand')->where('id', $data->brand_id)->first();
        $brand_name = $brand->brand_name;
        $cate = DB::table('tbl_category_product')->get();
        $brand = DB::table('tbl_brand')->get();
        return view('website.detailProduct', ['cate' => $cate, 'brand' => $brand, 'data' => $data, 'review' => $review, 'brand_name' => $brand_name]);
    }

    public function addToCart(Request $req, $id)
    {
        $product = DB::table('tbl_product')->where('id', $id)->first();
        $data['id'] = $product->id;
        $data['qty'] = 1;
        $data['weight'] = $product->size;
        $data['name'] = $product->product_name;
        $data['price'] = $product->price;
        $data['options']['image'] = $product->image;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }

    public function goToCart()
    {
        return view('website.cart');
    }

    public function deleteItem(Request $req, $id)
    {
        Cart::remove($id);
        return Redirect::to('/show-cart');
    }

    public function addQty(Request $req, $id, $qty)
    {
        Cart::update($id, $qty + 1);
        return Redirect::to('/show-cart');
    }

    public function numberQty(Request $req, $id, $qty)
    {
        $list = Cart::content();
        $rowId = '';
        foreach ($list as $item) {
            if($item->id == $id){
                $rowId = $item->rowId;
            }
        }
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }


    public function minusQty(Request $req, $id, $qty)
    {
        Cart::update($id, $qty - 1);
        return Redirect::to('/show-cart');
    }

    public function checkout(Request $req)
    {
        foreach (Cart::content() as $key => $value) {
            DB::table('tbl_bill')->insert(
                ['name' => $req->name, 'phone' => $req->phone, 'address' => $req->address, 'note' => $req->note, 'count' => $value->qty, 'user_id' => Auth::id(), 'product_id' => $value->id, 'price' => Cart::subtotal()]
            );
        }
        Session::put('success', 'Đặt hàng thành công. Xin cảm ơn!');
        $to = 'namdq97@gmail.com';
        $subject = 'Test email'; 
        $message = "Hello World!\n\nThis is my first mail."; 
        $headers = "From: *****@gmail.com\r\nReply-To: *****@gmail.com";
        $mail_sent = @mail( $to, $subject, $message, $headers );
        echo $mail_sent ? "Mail sent" : "Mail failed";
        Cart::destroy();
        return Redirect::to('/home');
    }

}
