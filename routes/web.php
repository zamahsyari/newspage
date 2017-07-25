<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index');
Route::get('detail', 'HomeController@detail');
Route::get('pdf', 'HomeController@pdf');
Route::get('kontrak', 'HomeController@kontrak');
Route::get('faq', 'HomeController@faq');
Route::get('article/{slug}', 'HomeController@article');
Route::get('page/{slug}', 'HomeController@page');

Route::get('admin', 'AdminController@index');
// Mnj Halaman
Route::get('admin/page/index','AdminController@pageIndex');
Route::get('admin/page/add','AdminController@pageAdd');
Route::post('admin/page/add','AdminController@pageInsert');
Route::get('admin/page/edit/{id}','AdminController@pageEdit');
Route::put('admin/page/edit/{id}','AdminController@pageUpdate');
Route::delete('admin/page/delete/{id}','AdminController@pageDelete');
Route::get('admin/getslug/{what}','AdminController@getSlug');
Route::get('admin/list/delete/{id}','AdminController@listDelete');
// Mnj Artikel
Route::get('admin/article/index','AdminController@articleIndex');
Route::get('admin/article/add','AdminController@articleAdd');
Route::post('admin/article/add','AdminController@articleInsert');
Route::get('admin/article/edit/{id}','AdminController@articleEdit');
Route::put('admin/article/edit/{id}','AdminController@articleUpdate');
Route::delete('admin/article/delete/{id}','AdminController@articleDelete');
// Mnj Kategori
Route::get('admin/category/index','AdminController@categoryIndex');
Route::get('admin/category/add','AdminController@categoryAdd');
Route::post('admin/category/add','AdminController@categoryInsert');
Route::get('admin/category/edit/{id}','AdminController@categoryEdit');
Route::put('admin/category/edit/{id}','AdminController@categoryUpdate');
Route::delete('admin/category/delete/{id}','AdminController@categoryDelete');
// Mnj Menu
Route::get('admin/menu/index','AdminController@menuIndex');
Route::post('admin/menu/add','AdminController@menuInsert');
Route::get('admin/menu/edit/{id}','AdminController@menuEdit');
Route::put('admin/menu/edit/{id}','AdminController@menuUpdate');
Route::get('admin/menu/delete/{id}','AdminController@menuDelete');