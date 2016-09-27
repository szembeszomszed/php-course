<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
Route::get('auth/github', 'Auth\RegisterController@redirectToProviderGithub');
Route::get('auth/github/callback', 'Auth\RegisterController@handleProviderCallbackGithub');
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

//Route::get('/login', function(){
//	return 'hacked login';
//});