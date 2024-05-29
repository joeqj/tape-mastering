<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginForm()
    {
        return view('user.login');
    }

    public function loginProcess()
    {
        validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        if (auth()->attempt(request()->only(['email', 'password']), request()->filled('remember'))) {
            return redirect('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logoutProcess()
    {
        auth()->logout();

        return redirect('/');
    }
}
