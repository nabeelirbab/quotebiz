<?php

namespace Acelle\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \Acelle\Http\Middleware\TrustProxies::class,
        // \Fruitcake\Cors\HandleCors::class,
        \Acelle\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Acelle\Http\Middleware\TrimStrings::class,
        \Acelle\Http\Middleware\CacheControlMiddleware::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Acelle\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Acelle\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'web_nocsrf' => [
            \Acelle\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            #\Acelle\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:1000,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Acelle\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin' => \Acelle\Http\Middleware\Admin::class,
        'super_admin' => \Acelle\Http\Middleware\SuperAdmin::class,
        'customer' => \Acelle\Http\Middleware\Customer::class,
        'service_provider' => \Acelle\Http\Middleware\ServiceProvider::class,
        'installed' => \Acelle\Http\Middleware\Installed::class,
        'not_installed' => \Acelle\Http\Middleware\NotInstalled::class,
        'not_logged_in' => \Acelle\Http\Middleware\NotLoggedIn::class,
        'subscription' => \Acelle\Http\Middleware\Subscription::class,
        'stripekey' => \Acelle\Http\Middleware\StripeKey::class,
        'validdomain' => \Acelle\Http\Middleware\ValidDomain::class,
        'subscription_rules' => \Acelle\Http\Middleware\SubscriptionRules::class,
    ];
}
