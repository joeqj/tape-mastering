<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewLogin()
    {
        return view('user.login');
    }

    public function login()
    {
        validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        if (auth()->attempt(request()->only(['email', 'password']), request()->filled('remember'))) {
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
