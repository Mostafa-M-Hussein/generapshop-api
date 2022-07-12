<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth ;
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

// run function from controller to import data
Route::get('get', 'App\Http\Controllers\DataImportController@importUnit');

Route::get('role', function () {

    $tag = \App\Models\Role::find(2);
    return $tag->users;


});


Route::get('c', function () {

    return \App\Models\Country::with(['cities', 'states'])->paginate(15);

});

Route::get('s', function () {

    return \App\Models\State::with(['cities', 'country'])->paginate(15);

});

Route::get('countries', function () {

    return \App\Models\City::with(['state', 'country'])->paginate(15);

});


Route::get('users', function () {
    return \App\Models\User::all();

});
Route::get('users', function () {
    return \App\Models\User::all();

});
Route::get('products', function () {
    return \App\Models\Product::with('images')->paginate(100);

});
Route::get('images', function () {
    return \App\Models\Image::paginate(100);

});
Route::get('reviews', function () {
    return \App\Models\Review::all();

});

Route::get('/', function () {
    return view('welcome');
});


Route::get('test_email', function () {
    return "Hello";
})->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//TODO  IMAGE ERROR WITH CSRF

Route::group( ['middleware' =>['auth' ] ]  , function () {


    //Units
    Route::get('units', 'App\Http\Controllers\UnitController@index')->name('units');
    Route::post('units', 'App\Http\Controllers\UnitController@store');
    Route::delete('units', 'App\Http\Controllers\UnitController@delete');
    Route::put('units', 'App\Http\Controllers\UnitController@update');
    Route::get('search-units', 'App\Http\Controllers\UnitController@search')->name('search-units');


    //Categories
    Route::get('categories', 'App\Http\Controllers\CategoryController@index')->name('categories');
    Route::post('categories', 'App\Http\Controllers\CategoryController@store');
    Route::get('search-categories', 'App\Http\Controllers\CategoryController@search')->name('search-categorie');
    Route::delete('categories', 'App\Http\Controllers\CategoryController@delete');
    Route::put('categories', 'App\Http\Controllers\CategoryController@update');

    //Products
    Route::get('products', 'App\Http\Controllers\ProductController@index')->name('products');


    Route::get('new-product', 'App\Http\Controllers\ProductController@newProduct')->name('new-product') ;
    Route::post('new-product', 'App\Http\Controllers\ProductController@store')->name('new-product') ;

    Route::get('update-product/{id}' ,'App\Http\Controllers\ProductController@newProduct')->name('update-product-form') ;

    Route::put('update-product' ,'App\Http\Controllers\ProductController@update')->name('update-product') ;
    Route::post ('delete-image' , 'App\Http\Controllers\ProductController@deleteImage')->name('delete-image') ;

    Route::delete('products', 'App\Http\Controllers\ProductController@delete');



    //Countries
    Route::get('countries', 'App\Http\Controllers\CountryController@index')->name('countries');

    //Cities
    Route::get('cities', 'App\Http\Controllers\CityController@index')->name('cities');

    //Payments

    //States
    Route::get('states', 'App\Http\Controllers\StateController@index')->name('states');

    //Roles
    Route::get('roles', 'App\Http\Controllers\RoleController@index')->name('roles');

    //Tags

    //Fix some problems
    Route::get('tags', 'App\Http\Controllers\TagController@index')->name('tags');
    Route::post('tags', 'App\Http\Controllers\TagController@store');
    Route::delete('tags' , 'App\Http\Controllers\TagController@delete'  ) ;
    Route::put('tags' , 'App\Http\Controllers\TagController@update'  ) ;
    Route::post('tags' , 'App\Http\Controllers\TagController@search'  )->name('search_tags');



    //Orders
    //Reviews
    Route::get('reviews', 'App\Http\Controllers\ReviewController@index')->name('reviews');

    // Tickets
    Route::get('tickets', 'App\Http\Controllers\TicketController@index')->name('tickets');

    //Shipments


}) ;
