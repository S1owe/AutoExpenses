<?php

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


Route::get('/', '\App\Http\Controllers\MainController@auth')->name('auth');

Route::post('/message',function(\Illuminate\Http\Request $request){
    \App\Events\Message::dispatch($request->input('body'));
});

