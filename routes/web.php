<?php

use App\Http\Controllers\smssController;
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

Route::get('/', function () {
    return view('welcome');
});

// Here is your custom route

Route::get('/send-message', 'smssController@create')->middleware('auth');

Route::resource('sms', 'smssController');

Route::post('/response', 'smssController@update');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
