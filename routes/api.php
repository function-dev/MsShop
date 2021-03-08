<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('collectionList', 'CollectionListController')->only([
    'index'
]);
Route::apiResource('products', 'ProductsController')->only([
    'index'
]);
Route::apiResource('ApiProducts', 'Api\AdminApi\ProductsController');
Route::apiResource('ApiCollectionList', 'Api\AdminApi\CollectionListController');
Route::apiResource('ApiAttr', 'Api\AdminApi\AttrController');
Route::post('ApiSearch', 'Api\AdminApi\ProductsController@search');


//Route::group(['middleware' => ['web']], function () {
//    Route::get('cookie/add','CookieController@addCookie');
//    Route::get('cookie/get','CookieController@getCookie');
//});
