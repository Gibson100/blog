<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
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


//Route::get('/users/{id}', function ($id) {
//    //return view('about');
//    return 'This is user : '.$id;
//});

/*
 *
 * *Routes for the application
 */
#index route
Route::get('/','App\Http\Controllers\PagesController@index');
#about route
Route::get('/about','App\Http\Controllers\PagesController@about');
#service route
Route::get('/services','App\Http\Controllers\PagesController@services');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostsController::class);

