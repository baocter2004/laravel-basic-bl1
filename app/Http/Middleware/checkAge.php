<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agefromp = $request->input('age', 0);
        if ($agefromp >= 18) {
            return $next($request);
        }
        if ($agefromp < 18) {
            abort(403,"bạn không đủ tuổi");
        }

        abort(403);
    }
}
