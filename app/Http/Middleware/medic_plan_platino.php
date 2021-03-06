<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class medic_plan_platino
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

     if(Auth::check() and Auth::user()->role == 'medico'){
        if(Auth::user()->medico->plan == 'plan_platino'){
        return $next($request);
      }else{
        return redirect()->route('planes_medic',\Hashids::encode(Auth::user()->medico_id))->with('warning', 'Para Poder acceder a ciertos Paneles, debes adquirir uno de nuestros planes, cada uno de estos te permitira hacer acciones extras en el sistema, a continuacion se detallan nuestros planes, de acuerdo a tu especialidad');
      }
  }elseif(Auth::check() and Auth::user()->role == 'Asistente'){
      if(Auth::user()->assistant->medico->plan == 'plan_platino'){
        return $next($request);
      }else{
        return redirect()->route('planes_medic',\Hashids::encode(Auth::user()->assistant->medico_id))->with('warning', 'Para Poder acceder a ciertos Paneles, debes adquirir uno de nuestros planes, cada uno de estos te permitira hacer acciones extras en el sistema, a continuacion se detallan nuestros planes, de acuerdo a tu especialidad');
      }

  }else{
      return redirect()->route('home')->with('warning','no tienes permisos para realizar esa acción, o tu session a expirado.');
  }

}
}
