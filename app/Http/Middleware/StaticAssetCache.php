<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaticAssetCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && $this->isStaticAsset($request)) {
            $maxAge = 31536000;

            $response->headers->set('Cache-Control', "public, max-age={$maxAge}, immutable");
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + $maxAge).' GMT');
            $response->headers->set('Pragma', 'public');
        }

        return $response;
    }

    protected function isStaticAsset(Request $request): bool
    {
        $path = $request->path();

        $extensions = [
            'css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg',
            'woff', 'woff2', 'ttf', 'eot', 'otf', 'mp4', 'webm', 'ico',
        ];

        foreach ($extensions as $ext) {
            if (str_ends_with($path, ".{$ext}")) {
                return true;
            }
        }

        return str_starts_with($path, 'build/') || str_starts_with($path, 'storage/');
    }
}
