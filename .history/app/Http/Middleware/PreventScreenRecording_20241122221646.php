<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventScreenRecording
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Ajouter les en-têtes de sécurité
        return $response->header('X-Frame-Options', 'DENY')
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline';")
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    }
}