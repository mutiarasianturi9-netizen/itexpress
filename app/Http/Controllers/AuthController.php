<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FORM LOGIN
    public function showLogin(){
        return view('auth.login');
    }

    // PROSES LOGIN
    public function login(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }
        return back()->with('error','Email atau password salah');
    }

    // FORM REGISTER
    public function showRegister(){
        return view('auth.register');
    }

    // PROSES REGISTER
    public function register(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>3 // user biasa
        ]);

        return redirect('/login');
    }

    // LOGOUT
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}