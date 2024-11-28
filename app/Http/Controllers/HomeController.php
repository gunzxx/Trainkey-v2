<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $users = User::limit(10)->with(['media'])->orderBy('high_point', 'DESC')->orderBy('count_word')->orderBy('created_at', 'ASC')->get();
        
        $users->map(function($user){
            if($user->id == auth()->user()->id){
                $user['authed'] = true;
            }
            return $user;
        });

        return view('home.index', [
            'user' => auth()->user(),
            'users' => $users,
        ]);
    }

    public function logout(){
        auth()->logout();
        return redirect('/login');
    }
}
