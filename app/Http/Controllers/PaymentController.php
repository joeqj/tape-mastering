<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    /*
        Creates a new Stripe session and redirects to the payment page
        @param Request: request
        @return Redirect: payment page
    */
    public function create(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $user = auth()->user();
        $entry_id = $request->get('entry_id');
        $coupon = $request->get('coupon');

        $args = [
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
            'customer_email' => $user->email,
            'allow_promotion_codes' => true,
            'success_url' => 'http://localhost/payment/success/' . $entry_id,
            'cancel_url' => 'http://localhost/payment/cancel/' . $entry_id,
        ];

        if ($coupon) {
            try {
                // We check the coupon before adding it to our args
                $coupon = $stripe->coupons->retrieve($request->get('coupon'), []);
                unset($args['allow_promotion_codes']);
                $args['discounts'] = [['coupon' => $coupon]];
            } catch (\Throwable $th) {
                // We do nothing here because the coupon isn't valid and therefore shouldn't be added
            }
        }

        $checkout_session = $stripe->checkout->sessions->create($args);

        return redirect($checkout_session->url);
    }

    /*
        Endpoint that checks if a coupon is valid and returns new price
        @param Request: request
        @returns JSON: response
    */
    public function checkCoupon(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        try {
            $coupon = $stripe->coupons->retrieve($request->get('coupon'), []);

            $total = $request->get('total');
            $discountTotal = $total / 100 * $coupon->percent_off;
            $total = $total - $discountTotal;

            return response()->json([
                'discount' => $discountTotal,
                'total' => $total,
                'error' => ''
            ]);
        } catch (\Throwable $error) {
            return response()->json([
                'error' => 'Coupon not found',
            ]);
        }
    }

    /*
        When a user has made a payment we update the Submission to reflect this and display a message
        @param Request: $request
        @return View: payment successful
    */
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

    /*
        When a user clicks back on the payment page we delete the post and any data and display a message
        @param Request: $request
        @return View: payment cancelled
    */
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
