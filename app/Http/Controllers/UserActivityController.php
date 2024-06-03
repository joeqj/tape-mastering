<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserActivityController extends Controller
{
    public function userLeaving(Request $request)
    {
        $upload = $request->input('upload_path');

        // Log::info('User leaving page', ['upload_path' => $upload]);

        if (Storage::disk('r2')->exists($upload)) {
            Storage::disk('r2')->delete($upload);
        }

        return response()->json(['message' => 'Temp file removed'], 200);
    }
}
