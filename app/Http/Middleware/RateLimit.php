<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;


class RateLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $key = 'session_' . $ip;

        if (Cache::has($key)) {
            // Session already in progress, return error response
            return response()->json(['error' => 'Another session in progress.'], 429);
        }

        // Set cache to mark session in progress
        Cache::put($key, true, now()->addMinutes(30));

        return $next($request);
    }
}
