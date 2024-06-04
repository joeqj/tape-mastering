<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
        Shows login page with any user notifications
        @param Request: request
        @return View: user login
    */
    public function showLogin(Request $request)
    {
        return view('user.login', [
            'message' => $request->get('message')
        ]);
    }

    /*
        Logs user in
        @param Request: request
        @return View: Error goes back to form, Success goes to dashboard
    */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validated) {
            if (auth()->attempt(request()->only(['email', 'password']), request()->filled('remember'))) {
                return redirect()->intended('dashboard');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }

    /*
        Logs user out
        @return Redirect: home
    */
    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    /*
        Validates user input before creating a User in the database
        @param Request: request
        @return Redirect: Error goes back to form, Success goes to login
    */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ], [
            'password.confirmed' => 'Your passwords do not match'
        ]);

        if ($validated) {
            User::factory()->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);

            return redirect()->route('login', [
                'message' => 'Account created, you can now login'
            ]);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }
}
