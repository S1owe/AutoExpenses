<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    public function new_chat (Request $request){

        $valid = $request->validate([
            'email' => ['required', 'string']
        ]);
        $receiver = DB::table('users')
            ->select(['name','id'])
            ->where('email',$request->email)
            ->first();

        $user_id = Auth::id();

        if (!$receiver){return response()->json(["new_chat"=>[
            'error' => "Пользователь с таким email не найден"
        ]]);}
        if(!DB::table('chats')->select('id')->where('creator_id','=', $user_id  or $request->id)->orWhere('receiver_id','=',$user_id  or $request->id)->first()){
            Chat::factory()->create([
                'creator_id' => $user_id,
                'receiver_id' => $receiver->id
            ]);
        }

        return response()->json(["new_chat"=>[
            'email' => $request->email,
            'user_name' => $receiver->name
        ]]);
    }
    public function load_chats(){
        $user_id = Auth::id();
        $chats = Chat::select('id')->where('creator_id',$user_id)->orWhere('receiver_id')->with('messages:chat_id,message,sender_name')->get();
        return $chats;
    }

    public function new_message(Request $request){
        $user_id = Auth::id();
        $valid = $request->validate([
            'chat_id' => ['required', 'integer'],
            'message' => ['rquired','string']
        ]);

        Message::create([
            'chat_id' => $request->chat_id,
            'message' => $request->message,
            'sender_name' => User::select('name')->where('id',$user_id)
        ]);

    }
}
