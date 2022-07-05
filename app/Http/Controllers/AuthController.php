<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{


    public function showLogin(){
        return Inertia::render("Login");
    }

    public function logout(){
        Auth::logout();
        return Inertia::location("/login");
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $defaultRoute = route("home");
            $intended_route = redirect()->intended($defaultRoute)->getTargetUrl(); 
            return Inertia::location($intended_route);
        }
 
        return back()->withErrors([
            'email' => "Parametres d'authentification incorrects.",
        ]);
    }
}
