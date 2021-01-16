<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{


    public function register() {
        return view('users.register');
    }

    public function postRegister(Request $request) {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);


        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('home');
    }

    public function login() {
        return view('users.login');
    }

    public function postLogin(Request $request) {

        $credentials = [
            "email" => $request->get("email"),
            "password" => $request->get("password"),
        ];

        if (Auth::attempt($credentials))
            return redirect()->route('ownposts');

        return Redirect::back()->with("status", "User not found");


    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }


}
