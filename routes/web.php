<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/catalog', 'Admin\AdminController@catalog');
    Route::get('/collection', 'Admin\AdminController@collection');
});
