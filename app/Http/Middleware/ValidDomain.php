<?php

namespace Acelle\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Acelle\Model\Subdomain;
use Redirect;
use Route;

class ValidDomain
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
         $account = Route::input('account');
         $subdomain = Subdomain::where('subdomain',$account)->first();
          if(!$subdomain){
            return Redirect::to('https://www.quotebiz.io');
          }
    }
}
