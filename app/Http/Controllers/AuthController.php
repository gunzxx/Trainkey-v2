<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
        // return response()->json([
        //     'message' => 'Login',
        // ]);
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|min:5',
            'password' => 'required',
        ]);
        // dd($request->all());
        if (auth()->attempt($request->only(['email', 'password']))) {
            $token = auth()->guard('api')->attempt($request->only(['email', 'password']));
            // return redirect('/')->withCookie('tes', $token);
            return redirect('/')->with('jwt', $token);
        }
        return redirect('/login')->withErrors([
            'message' => 'Email atau password salah',
        ])->withInput();
    }

    public function getRegister()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|min:5',
            'password' => 'required|confirmed:password_confirmation',
            'password_confirmation' => 'required',
            'profile' => 'mimes:webp,jpeg,png,jpg,gif,svg',
        ]);

        // dd($request->profile);
        try {
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if($request->file('profile')){
                $user->addMediaFromRequest('profile')->toMediaCollection('profile');
            }

            return redirect('/login')->with([
                'success' => 'Berhasil mendaftarkan akun',
            ]);
        } catch (\Throwable $th) {
            if($th->errorInfo[0] == 23000){
                return redirect('/register')->withErrors([
                    'error' => 'Email sudah digunakan',
                ])->withInput();
            }
            dd($th);
            return redirect('/register')->withErrors([
                'error' => 'Gagal mendaftarkan akun!',
            ]);
        }
    }
}
