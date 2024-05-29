<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function display()
    {
        return view('user.dashboard', [
            'user' => auth()->user()
        ]);
    }
}
