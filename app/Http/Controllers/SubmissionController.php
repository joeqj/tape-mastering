<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $user = auth()->user();

        $validated = $request->validate([
            'upload' => 'mimes:wav,flac,mp3,aiff'
        ]);

        if ($validated) {
            $file = $request->file('upload');
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

        return redirect()->route('dashboard')->withErrors(['errors' => 'There was an error with your submission. Please try again']);
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

        // We create a Validator object manually as the default validation produces a GET request and we wish to stick to POST at this stage.
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'user_upload' => ['required', 'string'],
            'status' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            // User has reached a scenario that should rarely happen:
            // Roll back the file the user uploaded and log info
            Log::info("A user faced a severe upload error: " . $user->email);

            $upload = $request->get('user_upload');

            if (Storage::disk('r2')->exists($upload)) {
                Storage::disk('r2')->delete($upload);
                Log::info("A user uploaded file was deleted: " . $upload);
            }

            return redirect()->route('dashboard')->withErrors(['errors' => 'There was an error with your submission. Please try again']);
        }

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
