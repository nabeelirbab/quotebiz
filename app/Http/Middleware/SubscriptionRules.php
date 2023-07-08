<?php

namespace Acelle\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubscriptionRules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
public function handle(Request $request, Closure $next)
{
    $customer = $request->user()->customer;
    $subscription = $customer->subscription;
    
    if ($request->path() === 'admin/mail') {
        if ($subscription->plan_id != 2 && $subscription->plan_id != 3 && $subscription->plan_id != 4 && $subscription->plan_id != 5) {
            return redirect('admin');
        }
    }
    
    if ($request->path() === 'admin/custom-domain') {
        if ($subscription->plan_id != 3 && $subscription->plan_id != 4 && $subscription->plan_id != 5) {
            return redirect('admin');
        }
    }
    
    return $next($request);
}


}
