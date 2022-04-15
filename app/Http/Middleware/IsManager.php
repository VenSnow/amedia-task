<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsManager
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Closure
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isManager()) {
            abort(403);
        }
        return $next($request);
    }
}
