<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthRequest;
// use App\Http\Requests;

class AuthController extends Controller
{
    public function show() {
        return view('welcome');
    }
    
    public function login(AuthRequest $request) {
        if (auth()->attempt($request->only(['email', 'password']))) {
            return redirect('dashboard');
        }

        return redirect()->back()->withErrors([
            'email' => 'Email is not signed up yet',    
            'password' => 'Wrong password',
        ]);
    }

    public function dashboard() {
        return view('dashboard', ['user' => auth()->user()]);
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
}
