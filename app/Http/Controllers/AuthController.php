<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Page de login
    public function login(){
        return view('auth.login');
    }

    // Vérification des identifiants
    public function dologin(LoginRequest $request){
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }
        return to_route('auth.login')->withErrors([
            'email' => "Token invalide"
        ])->onlyInput('email');
    }

    // Processus de logout
    public function logout(){
        Auth::logout();
        return to_route('blog.index');
    }
}
