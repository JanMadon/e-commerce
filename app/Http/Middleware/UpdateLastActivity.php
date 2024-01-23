<?php

namespace App\Http\Middleware;
 
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
 
class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = Auth::user()) {
            $user->timestamps    = false;
            $user->last_activity = now()->getTimestamp();
            $user->save();
        }
 
        return $next($request);
    }
}