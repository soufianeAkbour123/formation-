<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventRecording
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Content-Security-Policy', "default-src 'self'");
        
        return $response;
    }
}