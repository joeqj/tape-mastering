<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        $entry_id = $request->get('entry_id');

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => 'Audio to tape mastering service',
                    ],
                    'unit_amount' => 800,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost/payment/success/' . $entry_id,
            'cancel_url' => 'http://localhost/payment/cancel/' . $entry_id,
        ]);

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $user = auth()->user();

        $submission = Submission::orderBy('created_at', 'desc')
            ->where('user_id', $user->id)
            ->where('id', $request->route('id'))
            ->get();


        $entry = $submission->first();

        if ($entry && $entry->status == "pending") {
            $entry->status = "Paid";
            $entry->save();
        }

        return view('payment.success');
    }

    public function cancel(Request $request)
    {
        $user = auth()->user();

        $submission = Submission::orderBy('created_at', 'desc')
            ->where('user_id', $user->id)
            ->where('id', $request->route('id'))
            ->get();


        $entry = $submission->first();

        if ($entry && $entry->status == "pending") {

            if (Storage::disk('r2')->exists($entry->user_upload)) {
                Storage::disk('r2')->delete($entry->user_upload);
            }


            $entry->delete();
        }

        return view('payment.cancel');
    }
}
