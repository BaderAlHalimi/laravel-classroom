<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    //
    public function __invoke(Request $request, StripeClient $stripe)
    {

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_fa87fca759f77f83f95da2aeb1f1a3f191a240e544af19ae084f4fbb59f9a1cb';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                Payment::where('gateway_reference_id', $session->id)->update(
                    ['gateway_reference_id' => $session->payment_intent]
                );
                break;
            case 'payment_intent.amount_capturable_updated':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.canceled':
                $paymentIntent = $event->data->object;
                // Delete Subscription
                break;
            case 'payment_intent.created':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.partially_funded':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.requires_action':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $payment =  Payment::where('gateway_reference_id', $paymentIntent->id)->first();
                $payment->forceFill([
                    'status'=>'completed',
                ])->save();
                $subscription = Subscription::where('id',$payment->id)->first();
                $subscription->update([
                    'status'=>'active',
                    'expires_at'=>now()->addMonths(3),
                ]);
                default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('',200);
    }
}
