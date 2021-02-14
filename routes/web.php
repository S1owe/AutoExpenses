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

Route::get('/', '\App\Http\Controllers\MainController@index');
/*Route::get('/login', function(){
    if(Auth::check()) {
        return response()->json([
            'auth' => 'true'
        ]);
    }
});*/
//Route::post('/login', '\App\Http\Controllers\LoginController@login');
//Route::post('/register','\App\Http\Controllers\RegisterController@reg');

Route::name('user.')->group(function(){
    //Route::view('/private', 'private')->middleware('auth')->name('private');

    Route::get('/auth', function(){
        if(Auth::check()){
            return response()->json([
                'auth' => 'true'
            ]);
        }
        return  response()->json([
            'auth' => 'false'
        ]);
    })->name('auth');
    Route::post('/login','\App\Http\Controllers\AuthController@login');
    Route::post('/register','\App\Http\Controllers\AuthController@register');
    Route::get('/logout','\App\Http\Controllers\AuthController@logout')->name('logout');

});

