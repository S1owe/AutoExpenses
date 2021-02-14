<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'auth' => 'true'
            ]);
        }
        $valid = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if (DB::table('users')->where('email', $valid['email'])->exists()) {
            return response()->json([
                'auth' => 'false',
                'Error' => 'Такой уже зарегистрирован'
            ]);
        };

        $user = User::factory()->create($valid);
        if ($user) {
            Auth::login($user);
            return response()->json([
                'auth' => 'true'
            ]);
        }
        return response()->json([
            'auth' => 'false',
            'Error' => 'Произошла ошибка'
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'auth' => 'true'
            ]);
        }

        $login = $request->only('email', 'password');
        $user=DB::table('users')->select('email','password','name','id')->where('email',$login['email'])->where('password',$login['password'])->first();
        if ($user) {
            Auth::loginUsingId($user->id);
            return response()->json([
                'auth' => 'true'
            ]);
        }
        return response()->json([
            'auth' => 'false',
            'Error' => 'Неправильный логин или пароль'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'auth' => 'false'
        ]);
    }
}
