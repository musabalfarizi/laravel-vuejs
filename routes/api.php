<?php

use Illuminate\Http\Request;
use App\Events\SendGlobalNotification;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', function () {
    return view('selamat');
});

Route::post('/post', 'PostingController@store');

Route::get('send-notif/{name}', function ($name) {
    event(new SendGlobalNotification($name));
    return "Event has been sent!";
});

Route::resource('/cruds', 'CrudsController', ['except' => ['edit', 'show', 'store']]);

Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});