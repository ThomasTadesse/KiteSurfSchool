<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InstructeurMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isInstructeur()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Instructeur role required.'], 403);
            }
            
            return redirect('/login')->with('error', 'U heeft geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
