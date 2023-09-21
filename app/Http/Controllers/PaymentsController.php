<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\Payments\StripePayment;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Stripe\Charge;
use Stripe\StripeClient;

class PaymentsController extends Controller
{
    //
    public function create(StripePayment $stripe,Subscription $subscription)
    {
        return $stripe->createCheckoutSession($subscription);
    }
    public function store(StripeClient $stripe, Request $request)
    {
        //         \Stripe\Stripe::setApiKey($stripeSecretKey);
        // header('Content-Type: application/json');

        // $YOUR_DOMAIN = 'http://localhost:4242';

        // $checkout_session = \Stripe\Checkout\Session::create([
        //   'line_items' => [[
        //     # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        //     'price' => '{{PRICE_ID}}',
        //     'quantity' => 1,
        //   ]],
        //   'mode' => 'payment',
        //   'success_url' => $YOUR_DOMAIN . '/success.html',
        //   'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        // ]);
        

        // try {

        //     // Create a PaymentIntent with amount and currency
        //     $paymentIntent = $stripe->paymentIntents->create([
        //         'amount' => $subscription->price * 100,
        //         'currency' => 'usd',
        //         // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
        //         'automatic_payment_methods' => [
        //             'enabled' => true,
        //         ],
        //     ]);

        //     return [
        //         'clientSecret' => $paymentIntent->client_secret,
        //     ];
        // } catch (Error $e) {
        //     return Response::json([
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
    }
    public function success(Request $request)
    {
        return $request->all();
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $payment_intent = $stripe->paymentIntents->retrieve(
            $request->input('payment_intent'),
            []
        );
    }
    public function cancel(Request $request)
    {
        return $request->all();
    }
}
