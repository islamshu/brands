<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
class Device
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
       $user = auth('client_api')->user();
       $mob = request()->header('Device');
   
       if($mob != null){
        $user->mobile_type = $mob;
        // dd($user);
        $user->save();
       }
        return $next($request);
    }
}
