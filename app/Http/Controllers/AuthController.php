<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function do_login(Request $request){
        if(!$request->username || !$request->password){
            return redirect()->back()->with('error', 'Please enter your valid username & password');
        }
        $user = User::where('username', $request->username)->where('status', '>', 0)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Please enter your valid username & password');
        }
        if(!Auth::attempt([
            'email' => $user->email,
            'password' => $request->password
        ], true)){
            return redirect()->back()->with('error', 'Please enter your valid username & password');
        }
        return redirect()->back()->with('success', 'Login success!');
    }
}
