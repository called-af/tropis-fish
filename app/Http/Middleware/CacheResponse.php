<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && $response->isSuccessful()) {
            $response->headers->set('Cache-Control', 'public, max-age=3600, s-maxage=7200');
            $response->headers->set('Vary', 'Accept-Encoding');
            $response->setLastModified(now());
            $response->setEtag(md5($response->getContent()));

            if ($response->isNotModified($request)) {
                return $response;
            }
        }

        return $response;
    }
}
