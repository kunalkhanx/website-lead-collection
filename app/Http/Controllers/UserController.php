<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        return view('users.form');
    }

    public function do_create(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:160',
            'username' => 'required|min:4|max:25|unique:users,username',
            'email' => 'required|email|min:4|max:50|unique:users,email',
            'password' => 'required|min:8|max:25',
            'confirm_password' => 'required|same:password',
            'status' => 'nullable',
            'is_super' => 'nullable'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($request->status){
            $user->status = 0;
        }
        if($request->is_super){
            $user->is_super = 1;
        }
        $result = $user->save();
        if(!$result){
            return redirect()->back()->with('error', 'Unable to create user. Please try again!')->withInput();
        }
        return redirect()->back()->with('success', 'User created successfully!');
    }
}
