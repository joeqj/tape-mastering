<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /*
        Loads the main dashboard with a list of current user's Submissions
        TODO: we need to clean up old posts that are stuck in pending status
    */
    public function view()
    {
        $user = auth()->user();

        $sumbissions = Submission::orderBy('created_at', 'desc')->where('user_id', $user->id)->get();

        return view('user.dashboard', [
            'user' => $user,
            'submissions' => $sumbissions
        ]);
    }
}
