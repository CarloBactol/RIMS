<?php

namespace App\Http\Middleware;

use Closure;
use App\Events\UserLoggedIn;
use Illuminate\Http\Request;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = auth()->user();

        if ($user) {
            event(new UserLoggedIn($user));
        }

        return $next($request);
    }
}
