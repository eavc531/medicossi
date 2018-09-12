<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class verify_complete_medical_center
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
        if(Auth::check() and Auth::user()->role == 'medical_center'){
            if(Auth::user()->medicalCenter->statuss == 'complete'){
                return $next($request);
            }else{
                return redirect()->route('data_primordial_medical_center',\Hashids::encode(Auth::user()->medicalCenter->id))->with('warning', 'Antes de continuar debe rellenar la siguiente información');
            }

        }else{
            Auth::logout();
            redirect()->route('home')->with('warning', 'no tienes permisos para realizar la acción o tu session a expirado');
        }


    }
}
