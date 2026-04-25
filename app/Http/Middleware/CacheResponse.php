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

        // Don't cache non-GET requests
        if (! $request->isMethod('GET') || ! $response->isSuccessful()) {
            return $response;
        }

        // Don't cache admin pages — admin changes should reflect immediately
        if (str_starts_with($request->path(), 'admin') || str_starts_with($request->path(), 'login')) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');

            return $response;
        }

        // Don't cache Livewire AJAX requests
        if ($request->hasHeader('X-Livewire')) {
            return $response;
        }

        // Public pages: cache for 1 hour in browser, 2 hours on CDN/proxy
        $response->headers->set('Cache-Control', 'public, max-age=3600, s-maxage=7200');
        $response->headers->set('Vary', 'Accept-Encoding');

        // Generate ETag based on content hash for 304 Not Modified support
        $content = $response->getContent();
        if ($content) {
            $response->setEtag(md5($content));

            if ($response->isNotModified($request)) {
                return $response;
            }
        }

        return $response;
    }
}
