<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Models\Chat;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function test(){
        return view('event');
    }
    public function emit(){
        $chats = Chat::with(['user' => function($user){
            $user->with(['media']);
        }])->get();

        $chats->map(function($chat){
            $chat['profile_image'] = $chat->user->getFirstMediaUrl() == "" ? "/img/profile/default.png" : $chat->user->getFirstMediaUrl();
            // $chat['created_at'] = (new DateTime($chat->created_at))->format('Y-m-d H:i:s');
            $chat['username'] = $chat->user->name;
            $chat['authed'] = $chat->user->id == 1;
            unset($chat['user']);
            return $chat;
        });

        broadcast(new TestEvent($chats));
        return response()->json([
            'message' => 'Event broadcasted',
        ]);
    }
}
