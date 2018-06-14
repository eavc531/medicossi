<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class medic_plan_basic
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
      if(Auth::user()->role == 'medico'){
        return $next($request);
      }else{
        return redirect()->route('home')->with('warning', 'value');
      }
    }
}
