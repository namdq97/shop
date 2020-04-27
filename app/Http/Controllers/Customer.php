<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class Customer extends Controller
{
    public function all()
    {
        $data = DB::table('users')->get();
        return view('admin.allCustomer', ['data' => $data]);
    }

    public function listBySearch()
    {
        $data = DB::table('users')->where('email', 'LIKE', "%{$_GET['name']}%")->get();
        return view('admin.allCustomer', ['data' => $data]);
    }

    public function delete(Request $req, $id)
    {
        $result = DB::table('users')->where('id', $id)->delete();
        if ($result) {
            return Redirect::to('/admin/all-customer');
        }
    }
}
