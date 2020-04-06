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

//admin
Route::get('/admin', 'Admin@index');
Route::get('/admin/dashboard', 'Admin@showDashboard');
Route::get('/logout', 'Admin@logout');
Route::post('/admin-dashboard', 'Admin@login');

//product
Route::get('/admin/all-category-product', 'CategoryProduct@all');
Route::get('/admin/search-category-product', 'CategoryProduct@listBySearch');
Route::get('/admin/add-category-product', 'CategoryProduct@add');
Route::get('/admin/update-category-product', 'CategoryProduct@update');
Route::post('/admin/submit-category', 'CategoryProduct@submit');
Route::post('/admin/update-category/{id}', 'CategoryProduct@submitUpdate');



