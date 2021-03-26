<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*axis.post('messages',{body:"HALO"});
 axios.get('/api/init')
  .then(function (response) {
    // handle success
    console.log(response.data);
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
 */
/*
 * axios.post('message',{email:"bot1",password:"bot1",remember:false})
 axios.post('/api/login',{email:"bot1",password:"bot1",remember:false})
  .then(function (response) {
    // handle success
    console.log(response.data);
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
 */
Route::get('/init','\App\Http\Controllers\AuthController@init')->name('init');
Route::get('/new_chat','\App\Http\Controllers\MessageController@new_chat');
Route::get('/new_message','\App\Http\Controllers\MessageController@new_message');
Route::get('/load_chats','\App\Http\Controllers\MessageController@load_chats');
/*Route::get('/login', function(){
    if(Auth::check()) {
        return response()->json([
            'auth' => 'true'
        ]);
    }
});*/
Route::get('/event-create', '\App\Http\Controllers\EventController@create');
Route::get('/event-take', '\App\Http\Controllers\EventController@take');
Route::get('/map-take', '\App\Http\Controllers\MapController@take');
Route::name('user.')->group(function(){
    //Route::view('/private', 'private')->middleware('auth')->name('private');

    /*Route::get('/', function(){
        if(Auth::check()){
            return response()->json([
                'auth' => 'true'
            ]);
        }
        return view('auth');
        //return  response()->json(['auth' => 'false']);
    })->name('auth');*/
    Route::post('/login','\App\Http\Controllers\AuthController@login');
    Route::post('/register','\App\Http\Controllers\AuthController@register');
    Route::get('/logout','\App\Http\Controllers\AuthController@logout')->name('logout');

});

Route::get('/calc','\App\Http\Controllers\CalcController@calc')->name('calc');
Route::get('/marks','\App\Http\Controllers\CalcController@marks')->name('marks');
Route::get('/models','\App\Http\Controllers\CalcController@models')->name('models');
