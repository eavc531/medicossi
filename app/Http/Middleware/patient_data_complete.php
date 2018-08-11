<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class patient_data_complete
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

            if(Auth::user()->patient->stateConfirm == 'complete'){
                return $next($request);
            }else{
                return redirect()->route('address_patient',Auth::user()->patient->id)->with('success', 'Bienvendi@: '.Auth::user()->patient->name.' '.Auth::user()->patient->lastName.' antes de Continuar por favor agrega los datos correspondientes a tu dirección.');
            }


    }
}
