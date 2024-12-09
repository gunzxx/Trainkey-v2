<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'username' => 'required',
            'profile' => 'mimes:webp,jpeg,png,jpg,gif,svg|max:4096',
        ]);

        
        if(!$user = User::find(auth()->user()->id)){
            return redirect()->back()->withErrors([
                'message' => 'User not found',
            ]);
        }

        try {
            if($request->email != $user->email){
                $user->update([
                    'email' => $request->email,
                    'name' => $request->username,
                ]);
            }else{
                $user->update([
                    'name' => $request->username,
                ]);
            }
    
            if($request->file('profile')){
                $user->addMediaFromRequest('profile')->toMediaCollection('profile');
            }
    
            return redirect('/profile')->with([
                'success' => 'Data berhasil diperbarui',
            ]);
        } catch (\Throwable $th) {
            if($th->errorInfo[0] == 23000){
                return redirect()->back()->withErrors([
                    'email' => 'Email sudah digunakan',
                ]);
            }
            return redirect()->back()->withErrors([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function delete()
    {
        auth()->guard('api')->logout();
        auth()->user()->delete();

        return  response()->json([
            'success' => 'Akun berhasil dihapus'
        ]);
    }


    public function editPassword(){
        return view('profile.password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if(!auth()->attempt([
            'email' => auth()->user()->email,
            'password' => $request->old_password,
        ])){
            return redirect()->back()->withErrors([
                'message' => 'Password salah',
            ]);
        }

        if(!$user = User::find(auth()->user()->id)){
            return redirect()->back()->withErrors([
                'message' => 'User not found',
            ]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect('/password')->with([
            'success' => 'Password berhasil diperbarui',
        ]);
    }
}
