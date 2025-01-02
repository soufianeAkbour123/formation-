<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('maintenance_auth')) {
            return redirect()->route('maintenance.login');
        }
        return $next($request);
    }
}