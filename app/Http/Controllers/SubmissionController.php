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

            if ($sumbissions->count() < 2) {
                $new_user = true;
            }

            return view('user.upload', [
                'fileName' => $filename,
                'path' => $path,
                'new_user' => $new_user
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

            Submission::create($data);

            return redirect('/dashboard')->with('status', 'Your request has been submitted.');
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
