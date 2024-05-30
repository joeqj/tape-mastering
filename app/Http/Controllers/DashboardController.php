<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $user = auth()->user();

        $sumbissions = Submission::orderBy('created_at')->where('id', $user->id)->get();

        return view('user.dashboard', [
            'user' => $user,
            'submissions' => $sumbissions
        ]);
    }
}
