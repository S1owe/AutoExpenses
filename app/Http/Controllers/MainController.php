<?php

namespace App\Http\Controllers;

use App\Events\WebsocketDemoEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function auth(){
        //broadcast(new WebsocketDemoEvent('some data'));
        if(Auth::check()){
            view('auth',['auth' => 'true']);
        }
        return view('auth',['auth' => 'false']);
    }
}
