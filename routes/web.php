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
/*
Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/', 'PostController@halaman')->name('halaman');

Route::get('/posts/paginate', 'PostController@paginate');
Route::resource('/posts', 'PostController');


Auth::routes();
Route::middleware('auth')->name('card')->get('/cards/{card}', 'CardController@show');
Route::get('/leaderboard', 'CardController@leaderboard');

Route::get('/home', 'HomeController@index');

Route::get('post', 'PostController@create')->name('create');