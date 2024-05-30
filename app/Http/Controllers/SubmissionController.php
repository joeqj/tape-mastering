<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubmissionController extends Controller
{
    public function list()
    {
        $audio = Submission::orderByDesc('created_at')
            ->get();

        return view('pages.list', [
            'audio' => $audio
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('pages.create', [
            'users' => $users
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'user_id' => ['integer', Rule::exists('users', 'id')],
            'title' => ['string']
        ]);

        Submission::create($data);

        return redirect('/');
    }

    public function edit(Submission $post)
    {
        return view('pages.edit', [
            'post' => $post
        ]);
    }

    public function update(Submission $post)
    {
        $data = request()->validate([
            'title' => ['string']
        ]);

        $post->update($data);

        return redirect('/');
    }

    public function destroy(Submission $post)
    {
        $post->delete();

        return redirect('/');
    }
}
