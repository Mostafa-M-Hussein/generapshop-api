<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use  App\Http\Controllers\Api;
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
//Get  Categories
Route::get('/categories' ,  'App\Http\Controllers\Api\CategoryController@index' ) ;
Route::get('/categories/{id}' ,  'App\Http\Controllers\Api\TagController@show' ) ;

//Get  Tags
Route::get('/tags' ,  'App\Http\Controllers\Api\TagController@index' ) ;
Route::get('/tags/{id}' ,  'App\Http\Controllers\Api\TagController@show' ) ;

//Get products
Route::get('/products' ,  'App\Http\Controllers\Api\ProductController@index' ) ;
Route::get('/products/{id}' ,  'App\Http\Controllers\Api\ProductController@show' ) ;


//Genral Route
Route::get('/users' ,  function ()
{
    return \App\Http\Resources\UserFullResource::collection(\App\Models\User::paginate()  ) ;

}) ;

Route::get('/countries' ,  'App\Http\Controllers\Api\CountryController@index' ) ;
Route::get('/countries/{id}/states' ,  'App\Http\Controllers\Api\CountryController@showStates' ) ;
Route::get('/countries/{id}/cities' ,  'App\Http\Controllers\Api\CountryController@showCities' ) ;

Route::group(['middleware' => ['auth:sanctum'] ], function ()
{

});
