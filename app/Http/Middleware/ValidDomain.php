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
         $subdomain = Subdomain::where('subdomain',$account)->first();
          if(!$subdomain){
            return Redirect::to('https://www.quotebiz.io');
          }
        $url = request()->getHost();
        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{0,63}\.[a-z\.]{1,5})$/i', $domain, $regs)) {
            if($regs['domain'] == 'quotebiz.io'){
                $sub_domain_checker = Subdomain::select('parent')->where('subdomain',$subdomain)->where('status','active')->first();
                if($sub_domain_checker){
                   return Redirect::to('http://'.$sub_domain_checker->parent);
                }
            }
        }
          
           return $next($request);
    }
}
