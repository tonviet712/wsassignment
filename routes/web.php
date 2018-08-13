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

Route::get('/', function () {
    return view('welcome');
});
// UserController

Route::put('/user/{username}', 'UserController@update');
Route::get('/user/{name}/update', 'UserController@showUpdateForm') ;
Route::get('/user/{name}/avatar', 'UserController@showAvatarForm') ;
Route::post('/user/{name}/avatar', 'UserController@uploadAvatar') ;
Route::get('/user/{username}', 'UserController@display')->name('user.display')->middleware('basicAuth') ;



Route::get('/', 'HomeController@index') ;
Route::post('/user', 'Auth\RegisterController@register') ;
Auth::routes();




