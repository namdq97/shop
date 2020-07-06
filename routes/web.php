<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//web
Route::get('/', 'Home@index');
Route::get('/home', 'Home@index');

//review
Route::post('/submit-review/{id}', 'Review@submit');


//product
Route::get('/danh-sach-san-pham', 'CategoryProduct@show_list_product');
Route::get('/chi-tiet-san-pham/{id}', 'Product@detailProduct');
Route::get('/cart/{id}', 'Product@addToCart');
Route::get('/show-cart', 'Product@goToCart');
Route::get('/delete/{id}', 'Product@deleteItem');
Route::get('/add/{id}/{qty}', 'Product@addQty');
Route::get('/minus/{id}/{qty}', 'Product@minusQty');
Route::post('/checkout', 'Product@checkout');
Route::get('/my-bill', 'Bill@detail');
Route::get('/update-my-bill', 'Bill@cancel');
//auth
Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/log-out', function(){
    Auth::logout();
    return Redirect::to('/');
});

Route::get('/profile', 'Profile@updateProfile');
Route::post('/submit-profile', 'Profile@submitUpdateProfile');
Route::get('/change-pass', 'Profile@updatePassword');
Route::post('/submit-password', 'Profile@submitUpdatePassword');

//News
Route::get('/tin-tuc', 'News@allNews');
Route::get('/chi-tiet-tin-tuc/{id}', 'News@detailNews');

//Admin
//auth
Route::get('/admin', 'Admin@index');
Route::get('/admin/dashboard', 'Admin@showDashboard');
Route::get('/logout', 'Admin@logout');
Route::post('/admin-dashboard', 'Admin@login');


Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    //product category
    Route::get('/all-category-product', 'CategoryProduct@all');
    Route::get('/search-category-product', 'CategoryProduct@listBySearch');
    Route::get('/add-category-product', 'CategoryProduct@add');
    Route::get('/update-category-product', 'CategoryProduct@update');
    Route::post('/submit-category', 'CategoryProduct@submit');
    Route::post('/update-category/{id}', 'CategoryProduct@submitUpdate');
    Route::get('/del-category/{id}', 'CategoryProduct@delete');

    //brand
    Route::get('/all-brand-product', 'BrandProduct@all');
    Route::get('/search-brand-product', 'BrandProduct@listBySearch');
    Route::get('/add-brand-product', 'BrandProduct@add');
    Route::get('/update-brand-product', 'BrandProduct@update');
    Route::post('/submit-brand', 'BrandProduct@submit');
    Route::post('/update-brand/{id}', 'BrandProduct@submitUpdate');
    Route::get('/del-brand/{id}', 'BrandProduct@delete');

    //product
    Route::get('/all-product', 'Product@all');
    Route::get('/search-product', 'Product@listBySearch');
    Route::get('/add-product', 'Product@add');
    Route::get('/update-product', 'Product@update');
    Route::post('/submit-product', 'Product@submit');
    Route::post('/update-product/{id}', 'Product@submitUpdate');
    Route::get('/del-product/{id}', 'Product@delete');

    //user
    Route::get('/all-user', 'User@all');
    Route::get('/search-user', 'User@listBySearch');
    Route::get('/add-user', 'User@add');
    Route::get('/update-user', 'User@update');
    Route::post('/submit-user', 'User@submit');
    Route::post('/update-user/{id}', 'User@submitUpdate');
    Route::get('/del-user/{id}', 'User@delete');

     //user
     Route::get('/all-customer', 'Customer@all');
     Route::get('/search-customer', 'Customer@listBySearch');
    //  Route::get('/add-customer', 'Customer@add');
    //  Route::get('/update-customer', 'Customer@update');
    //  Route::post('/submit-customer', 'Customer@submit');
    //  Route::post('/update-customer/{id}', 'Customer@submitUpdate');
     Route::get('/del-customer/{id}', 'Customer@delete');

    //user
     Route::get('/all-review', 'Review@all');
    //  Route::get('/search-review', 'Review@listBySearch');
    //  Route::get('/add-review', 'Review@add');
    //  Route::get('/update-review', 'Review@update');
    //  Route::post('/submit-review', 'Review@submit');
    //  Route::post('/update-review/{id}', 'Review@submitUpdate');
     Route::get('/del-review/{id}', 'Review@delete');

    //news
    Route::get('/all-news', 'News@all');
    Route::get('/search-news', 'News@listBySearch');
    Route::get('/add-news', 'News@add');
    Route::get('/update-news', 'News@update');
    Route::post('/submit-news', 'News@submit');
    Route::post('/update-news/{id}', 'News@submitUpdate');
    Route::get('/del-news/{id}', 'News@delete');

    //bill
    Route::get('/all-bill', 'Bill@all');
    Route::post('/filter-bill', 'Bill@filter');
    // Route::get('/search-bill', 'Bill@listBySearch');
    Route::get('/del-bill/{id}', 'Bill@delete');
    Route::get('/export-bill/{id}', 'Bill@export');
    Route::get('/update-bill', 'Bill@update');


    //profile
    Route::get('/profile', 'Admin@profile');
    Route::get('/change-password', 'Admin@changePassword');
    Route::post('/update-profile', 'Admin@updateProfile');
    Route::post('/update-password', 'Admin@updatePassword');

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
