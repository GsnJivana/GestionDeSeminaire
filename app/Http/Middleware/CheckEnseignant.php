<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEnseignant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (strcasecmp(Auth::user()->getAttribute("role"),"enseignant") || !auth()->check()  ) {
        abort(403, 'Espace reserve aux enseigants!');
        }
        else {
            return $next($request);
        }
    }
}
