<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\File;

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

    public function create(Request $request)
    {
        $validated = $request->validate([
            'dropzone-file' => 'mimes:wav,flac,mp3,aiff'
        ]);

        if ($validated) {
            $user = auth()->user();

            $file = $request->file('dropzone-file');
            $filename = $file->getClientOriginalName();
            $path = $file->store('uploads', 'r2');

            return view('user.upload', [
                'fileName' => $filename,
                'path' => $path
            ]);
        }

        return redirect()->back()->withErrors(['upload' => 'Invalid File']);
    }

    public function error()
    {
        return view('user.error');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'title' => ['string'],
            'comment' => ['string'],
            'upload' => ['mimes:wav,flac,mp3,aiff']
        ]);

        if ($validated) {
            $data = [
                'title' => $request->get('title'),
                'comment' => $request->get('comment'),
                'user_id' => $user->id
            ];

            Submission::create($data);
        }

        return redirect()->back()->withErrors(['title' => 'Invalid Description']);
    }

    // public function edit(Submission $post)
    // {
    //     return view('pages.edit', [
    //         'post' => $post
    //     ]);
    // }

    // public function update(Submission $post)
    // {
    //     $data = request()->validate([
    //         'title' => ['string']
    //     ]);

    //     $post->update($data);

    //     return redirect('/');
    // }

    // public function destroy(Submission $post)
    // {
    //     $post->delete();

    //     return redirect('/');
    // }
}
