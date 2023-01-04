<?php

namespace Acelle\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Acelle\Model\Subdomain;
use Acelle\Model\Setting;
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

         $account = Setting::subdomain();
      #  $request->route()->setParameter('account',  'noble');
      #  $account = 'noble';

         $subdomain = Subdomain::where('subdomain',$account)->first();
          if(!$subdomain){
            return Redirect::to('https://www.quotebiz.io');
          }
           return $next($request);
    }
}
