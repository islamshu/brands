<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            // dd(Auth::user()->getRoles());
            if (Auth::user()->hasRole($role)) {

                return $next($request);
            } else {
                return $next($request);

                return Redirect::route('dashboard.error_pages.not_permissions', ['locale' => app()->getLocale()]);
            }
        } else {
            return Redirect::route('dashboard.auth.login', ['locale' => app()->getLocale()]);
        }
    }
}
