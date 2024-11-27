<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'showState' => 'required',
        ]);
        if($request->showState == 'all'){
            $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->get();
        }else if($request->showState == 'less'){
            $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->limit(10)->get();
        }

        // $users->map(function($user){
        //     if($user->id == auth()->user()->id){
        //         $user['authed'] = true;
        //     }
        //     return $user;
        // });

        return response()->json($users);
    }
    
    public function showall(Request $request)
    {
        $request->validate([
            'showState' => 'required',
        ]);
        if($request->showState == 'all'){
            $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->limit(10)->get();
        }else if($request->showState == 'less'){
            $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->get();
        }
        
        // $users->map(function($user){
        //     if($user->id == auth()->user()->id){
        //         $user['authed'] = true;
        //     }
        //     return $user;
        // });

        return response()->json($users);
    }

    public function update(Request $request){
        $request->validate([
            'highPoint' => 'required',
            'countWord' => 'required',
        ]);

        $user = User::find(1);
        $user->update([
            'high_point' => $request->highPoint,
            'count_word' => $request->countWord,
        ]);
        
        return response()->json($user);
    }
        
    public function rank(Request $request)
    {
        $request->validate([
            'showState' => 'required',
        ]);
        if($request->showState == 'all'){
            $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->get();
        }else if($request->showState == 'less'){
            $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->limit(10)->get();
        }
        
        // $users->map(function($user){
        //     if($user->id == auth()->user()->id){
        //         $user['authed'] = true;
        //     }
        //     return $user;
        // });

        return response()->json($users);
    }
}
