<?php
use Illuminate\Support\Facades\Route;
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

//auth
Route::get('/admin', 'Admin@index');
Route::get('/admin/dashboard', 'Admin@showDashboard');
Route::get('/logout', 'Admin@logout');
Route::get('/admin/profile', 'Admin@profile');
Route::get('/admin/change-password', 'Admin@changePassword');
Route::post('/admin/update-profile', 'Admin@updateProfile');
Route::post('/admin/update-password', 'Admin@updatePassword');
Route::post('/admin-dashboard', 'Admin@login');

//product category
Route::get('/admin/all-category-product', 'CategoryProduct@all');
Route::get('/admin/search-category-product', 'CategoryProduct@listBySearch');
Route::get('/admin/add-category-product', 'CategoryProduct@add');
Route::get('/admin/update-category-product', 'CategoryProduct@update');
Route::post('/admin/submit-category', 'CategoryProduct@submit');
Route::post('/admin/update-category/{id}', 'CategoryProduct@submitUpdate');
Route::get('/admin/del-category/{id}', 'CategoryProduct@delete');

//brand
Route::get('/admin/all-brand-product', 'BrandProduct@all');
Route::get('/admin/search-brand-product', 'BrandProduct@listBySearch');
Route::get('/admin/add-brand-product', 'BrandProduct@add');
Route::get('/admin/update-brand-product', 'BrandProduct@update');
Route::post('/admin/submit-brand', 'BrandProduct@submit');
Route::post('/admin/update-brand/{id}', 'BrandProduct@submitUpdate');
Route::get('/admin/del-brand/{id}', 'BrandProduct@delete');

//product
Route::get('/admin/all-product', 'Product@all');
Route::get('/admin/search-product', 'Product@listBySearch');
Route::get('/admin/add-product', 'Product@add');
Route::get('/admin/update-product', 'Product@update');
Route::post('/admin/submit-product', 'Product@submit');
Route::post('/admin/update-product/{id}', 'Product@submitUpdate');
Route::get('/admin/del-product/{id}', 'Product@delete');



