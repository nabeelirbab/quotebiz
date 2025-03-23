<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Acelle\Model\Subscription;
use Acelle\Model\Invoice;
use Acelle\Model\Transaction;
use Carbon\Carbon;

class PayPalWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        Log::info('PayPal Webhook Received: ', $payload);

        if (!isset($payload['event_type'])) {
            Log::warning('Webhook missing event_type.');
            return response()->json(['error' => 'Invalid webhook data'], 400);
        }

        switch ($payload['event_type']) {
            case "PAYMENT.SALE.COMPLETED":
                return $this->handlePaymentCompleted($payload);

            // Optional: still keep these if needed
            case "BILLING.SUBSCRIPTION.PAYMENT.SUCCEEDED":
                return $this->handleSubscriptionPaymentSuccess($payload);

            case "BILLING.SUBSCRIPTION.RENEWED":
                return $this->handleSubscriptionRenewed($payload);

            default:
                Log::info('Unhandled PayPal event type: ' . $payload['event_type']);
                return response()->json(['message' => 'Event ignored'], 200);
        }
    }

    private function handlePaymentCompleted($payload)
    {
        $resource = $payload['resource'] ?? [];
        $subscriptionId = $resource['billing_agreement_id'] ?? null;
        $amount = $resource['amount']['total'] ?? null;
        $currency = $resource['amount']['currency'] ?? null;

        if (!$subscriptionId) {
            Log::error('Missing billing_agreement_id in PAYMENT.SALE.COMPLETED webhook.');
            return response()->json(['error' => 'Missing subscription ID'], 400);
        }

        $subscription = Subscription::where('paypal_subscription_id', $subscriptionId)->first();

        if (!$subscription) {
            Log::error("Subscription not found: {$subscriptionId}");
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        // Renew subscription using your existing logic
        $subscription->renew(); // uses Subscription::renew()
        Log::info("Subscription renewed via webhook: {$subscriptionId}");

        // Save transaction
        $invoice = $subscription->getUnpaidInvoice();

        if ($invoice) {
            Transaction::create([
                'invoice_id' => $invoice->id,
                'status' => 'success',
                'method' => 'paypal',
                'amount' => $amount,
                'currency' => $currency,
            ]);
        } else {
            Log::warning("No unpaid invoice found for subscription: {$subscriptionId}");
        }

        return response()->json(['message' => 'Payment processed and subscription renewed'], 200);
    }

    private function handleSubscriptionPaymentSuccess($payload)
    {
        Log::info('Received deprecated event BILLING.SUBSCRIPTION.PAYMENT.SUCCEEDED');
        return response()->json(['message' => 'Event received (not used)'], 200);
    }

    private function handleSubscriptionRenewed($payload)
    {
        Log::info('Received deprecated event BILLING.SUBSCRIPTION.RENEWED');
        return response()->json(['message' => 'Event received (not used)'], 200);
    }
}
