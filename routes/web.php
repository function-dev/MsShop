<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\base64_converter;

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

Auth::routes(['register' => false]);


Route::get('/', 'HomeController@index')->name('index');

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/catalog', 'Admin\AdminController@catalog')->name('admin.catalog');
    Route::get('/catalog/add', 'Admin\AdminController@addProduct')->name('admin.add');
    Route::get('/collection', 'Admin\AdminController@collection')->name('admin.collection');
    Route::get('/collection/add', 'Admin\AdminController@addCollection')->name('admin.addCollection');
    Route::get('/collection/edit/{id}', 'Admin\AdminController@editCollection')->name('admin.editCollection');
    Route::get('/catalog/edit/{id}', 'Admin\AdminController@editProduct')->name('admin.editProduct');
});

