<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\admin;
use App\Models\club;

class LoginMiddleware
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
            if(null==session()->get('Authority')){
                return redirect('/home');
            }else{
                return $next($request);
            }
    }
}
