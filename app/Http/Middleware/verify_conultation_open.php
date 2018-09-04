<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Route;
class verify_conultation_open
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
        if(Auth::check())   {
            if(Auth::user()->role == 'medico'){
                if(Auth::user()->medico->event_id != Null and Route::currentRouteName() != 'manage_patient'){
                    return redirect()->route('manage_patient',['m_id'=>\Hashids::encode(Auth::user()->medico->event->medico_id),'p_id'=>\Hashids::encode(Auth::user()->medico->event->patient_id)])->with('warning', 'Antes de salir de la gestion de datos del paciente: '.Auth::user()->medico->event->namePatient.' debes cerrar la consulta actualmente abierta');
                }
            }

            elseif(Auth::user()->role == 'Asistente'){
                return $next($request);
            }else{
                return $next($request);
            }
        }

        return $next($request);
    }

}
