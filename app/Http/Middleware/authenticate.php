<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class authenticate
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



      if(Auth::check() == false){

        return redirect()->route('home')->with('warning', 'Su sessión ha expirado.');
      }

        if(Auth::check()){
            if(Auth::user()->role == 'medico'){
                // if(Auth::user()->stateConfirm != 'data_primordial_complete' ){
                //       return redirect()->route('data_primordial_medico',Auth::user()->medico_id)->with('warning', 'Debes completar tus datos para poder continuar');
                // }elseif(Auth::user()->stateConfirm != 'complete'){
                //     return redirec()->route('data_primordial_medico',Auth::user()->medico_id)->with('warning', 'Debes completar tus datos para poder continuar');
                // }else{
                    return $next($request);
                // }

            }else{
                return $next($request);
            }
        }
    }
}
