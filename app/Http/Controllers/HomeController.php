<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $users = User::all();
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
