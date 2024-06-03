<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

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
            $path = $file->store('user_uploads', 'r2');

            $sumbissions = Submission::orderBy('created_at', 'desc')->where('user_id', $user->id)->get();
            $new_user = false;
            $discount_songs_left = 2;

            if ($sumbissions->count() < 2) {
                $new_user = true;
                $discount_songs_left = $discount_songs_left - $sumbissions->count();
            }

            return view('user.upload', [
                'fileName' => $filename,
                'path' => $path,
                'new_user' => $new_user,
                'discount_songs_left' => $discount_songs_left
            ]);
        }

        return redirect()->back()->withErrors(['upload' => 'Invalid File']);
    }

    public function error(Request $request)
    {
        return view('user.error', [
            'error' => $request->get('error')
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'title' => ['required', 'string'],
            'user_upload' => ['required', 'string'],
            'status' => ['required', 'string']
        ]);

        if ($validated) {

            $data = [
                'title' => $request->get('title'),
                'comment' => $request->get('comment'),
                'user_id' => $user->id,
                'user_upload' => $request->get('user_upload'),
                'status' => $request->get('status')
            ];

            $id = Submission::create($data);

            return redirect()->route('create-checkout-session', [
                'entry_id' => $id
            ]);
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

    public function destroy(Submission $post)
    {
        $post->delete();

        return redirect('/');
    }
}
