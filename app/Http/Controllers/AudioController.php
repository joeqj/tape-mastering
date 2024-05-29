<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\User;
use Illuminate\Validation\Rule;

class AudioController extends Controller
{
    public function list()
    {
        $audio = Audio::orderByDesc('created_at')
            ->get();

        return view('list', [
            'audio' => $audio
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('create', [
            'users' => $users
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'user_id' => ['integer', Rule::exists('users', 'id')],
            'title' => ['string']
        ]);

        Audio::create($data);

        return redirect('/');
    }

    public function edit(Audio $post)
    {
        return view('edit', [
            'post' => $post
        ]);
    }

    public function update(Audio $post)
    {
        $data = request()->validate([
            'title' => ['string']
        ]);

        $post->update($data);

        return redirect('/');
    }

    public function destroy(Audio $post)
    {
        $post->delete();

        return redirect('/');
    }
}
