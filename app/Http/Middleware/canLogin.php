<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class canLogin
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
        if (!$request->user()->canLogin()) {
            return redirect('/login')->with('error', 'You are not allowed to login.');
        }

        return $next($request);
    }
}
