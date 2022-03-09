<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Auth;

class CheckBranch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('Branches')) {
                return $next($request);
            } else {
                return Redirect::route('dashboard.error_pages.not_permissions', ['locale' => app()->getLocale()]);
            }
        } else {
            return Redirect::route('dashboard.auth.login', ['locale' => app()->getLocale()]);
        }
    }
}
