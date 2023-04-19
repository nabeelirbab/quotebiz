<?php

namespace Acelle\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($this->shouldSetCacheControlHeader($response)) {
            $response->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        return $response;
    }

    /**
     * Determine if the cache control headers should be set for the response.
     *
     * @param  mixed  $response
     * @return bool
     */
    protected function shouldSetCacheControlHeader($response)
    {
        if ($response instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return false;
        }

        if (!$response->isSuccessful()) {
            return false;
        }

        $contentTypes = ['text/css', 'application/javascript', 'image/', 'font/'];

        foreach ($contentTypes as $contentType) {
            if (str_contains($response->headers->get('Content-Type'), $contentType)) {
                return true;
            }
        }

        return false;
    }
}