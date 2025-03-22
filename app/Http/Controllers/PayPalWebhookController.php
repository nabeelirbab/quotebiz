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
        // Get PayPal Webhook Event
        $payload = $request->all();
        Log::info('PayPal Webhook Received: ', $payload);

        // Verify Event Type
        if (!isset($payload['event_type'])) {
            return response()->json(['error' => 'Invalid webhook data'], 400);
        }

        // Check for Subscription Payment Success
        if ($payload['event_type'] == "BILLING.SUBSCRIPTION.PAYMENT.SUCCEEDED") {
            return $this->handleSubscriptionPaymentSuccess($payload);
        }

        // Subscription Renewed Event
        if ($payload['event_type'] == "BILLING.SUBSCRIPTION.RENEWED") {
            return $this->handleSubscriptionRenewed($payload);
        }

        return response()->json(['message' => 'Webhook received'], 200);
    }

    private function handleSubscriptionPaymentSuccess($payload)
    {
        $subscriptionId = $payload['resource']['billing_agreement_id'] ?? null;
        $amount = $payload['resource']['amount']['value'];
        $currency = $payload['resource']['amount']['currency_code'];

        if (!$subscriptionId) {
            Log::error('Missing subscription ID in webhook.');
            return response()->json(['error' => 'Missing subscription ID'], 400);
        }

        // Find Subscription by PayPal ID
        $subscription = Subscription::where('paypal_subscription_id', $subscriptionId)->first();

        if (!$subscription) {
            Log::error("Subscription not found: {$subscriptionId}");
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        // Renew Subscription in Database
        $subscription->status = 'active';
        $subscription->current_period_ends_at = Carbon::now()->addMonths(1);
        $subscription->save();

        // Create Transaction Record
        Transaction::create([
            'invoice_id' => $subscription->getUnpaidInvoice()->id,
            'status' => 'success',
            'method' => 'paypal',
            'amount' => $amount,
            'currency' => $currency,
        ]);

        Log::info("Subscription renewed successfully: {$subscriptionId}");

        return response()->json(['message' => 'Subscription payment recorded'], 200);
    }

    private function handleSubscriptionRenewed($payload)
    {
        $subscriptionId = $payload['resource']['id'] ?? null;

        if (!$subscriptionId) {
            Log::error('Missing subscription ID in webhook.');
            return response()->json(['error' => 'Missing subscription ID'], 400);
        }

        // Find Subscription by PayPal ID
        $subscription = Subscription::where('paypal_subscription_id', $subscriptionId)->first();

        if (!$subscription) {
            Log::error("Subscription not found: {$subscriptionId}");
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        // Update Subscription Status
        $subscription->status = 'active';
        $subscription->current_period_ends_at = Carbon::now()->addMonths(1);
        $subscription->save();

        Log::info("Subscription renewed successfully: {$subscriptionId}");

        return response()->json(['message' => 'Subscription renewal updated'], 200);
    }
}
