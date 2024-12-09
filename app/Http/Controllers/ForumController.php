<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['user' => function($user){
            $user->with(['media']);
        }])->get();
        return view('forum.index', [
            'chats' => $chats,
        ]);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->getMessageBag(), 400);
        }

        Chat::create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
        ]);

        $chats = Chat::with(['user' => function($user){
            $user->with(['media']);
        }])->get();

        $chats->map(function($chat){
            $chat['profile_image'] = $chat->user->getFirstMediaUrl() == "" ? "/img/profile/default.png" : $chat->user->getFirstMediaUrl();
            // $chat['created_at'] = (new DateTime($chat->created_at))->format('Y-m-d H:i:s');
            $chat['username'] = $chat->user->name;
            $chat['authed'] = $chat->user->id == auth()->user()->id;
            unset($chat['user']);
            return $chat;
        });

        return response()->json([
            'chats' => $chats,
            'message' => 'Data berhasil ditambahkan'
        ]);
    }
}
