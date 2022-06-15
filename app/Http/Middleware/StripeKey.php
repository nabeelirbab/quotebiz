<?php

namespace Acelle\Http\Middleware;

use Closure;

class StripeKey
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $stripekey = $request->user()->stripekey;
        // Check if customer dose not have subscription
        if (!$stripekey) {
           // dd($stripekey);
            // return redirect('stripekey');
             return redirect('stripekey');
        }

        return $next($request);
    }
}
