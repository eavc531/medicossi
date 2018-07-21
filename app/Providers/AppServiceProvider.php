<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //PERMISOS asistentes



    
        Blade::if('cita_create', function(){
            if(Auth::check() and Auth::user()->role == 'medico'){
                return app();

            }else{
                if(Auth::user()->assistant->permission->cita_patient_create != Null){
                    return app();
                }
            }

        });
        Blade::if('cita_person_create', function(){
            if(Auth::check() and Auth::user()->role != 'medico' and Auth::user()->assistant->permission->endcita_person_create != Null){
                return app();
            }
        });


        //
        Blade::if('assistant', function(){
            if(Auth::check() and Auth::user()->role == 'Asistente'){
                        return app();
            }
      });

        Blade::if('plan_agenda', function(){
            if(Auth::check() and Auth::user()->role == 'Asistente'){
                if(Auth::user()->assistant->medico->plan == "plan_agenda" or Auth::user()->assistant->medico->plan == "plan_profesional" or Auth::user()->assistant->medico->plan == "plan_platino"){
                        return app();
                    }

            }elseif(Auth::check() and Auth::user()->role == 'medico'){
                if(Auth::user()->medico->plan == "plan_agenda" or Auth::user()->medico->plan == "plan_profesional" or Auth::user()->medico->plan == "plan_platino"){
                    return app();
                }

            }
      });

      Blade::if('plan_profesional', function(){
          if(Auth::check() and Auth::user()->role == 'Asistente'){
              if(Auth::user()->assistant->medico->plan == "plan_profesional" or Auth::user()->assistant->medico->plan == "plan_platino"){
                  return app();

              }
          }elseif(Auth::check() and Auth::user()->role == 'medico'){
              if(Auth::user()->medico->plan == "plan_profesional" or Auth::user()->medico->plan == "plan_platino"){
                  return app();
              }

              }
    });

        Blade::if('plan_platino', function(){
            if(Auth::check() and Auth::user()->role == 'Asistente'){
                if(Auth::user()->assistant->medico->plan == "plan_platino"){
                    return app();
                }

            }elseif(Auth::check() and Auth::user()->role == 'medico'){
                if(Auth::user()->medico->plan == "plan_platino"){
                    return app();
                }

                }
      });

      Blade::if('plan_agenda_no', function(){
          if(Auth::check() and Auth::user()->role == 'Asistente'){
              if(Auth::user()->assistant->medico->plan != "plan_agenda" and Auth::user()->assistant->medico->plan != "plan_profesional" and Auth::user()->assistant->medico->plan != "plan_platino"){
                  return app();
              }

          }elseif(Auth::check() and Auth::user()->role == 'medico'){
              if(Auth::user()->medico->plan != "plan_agenda" and Auth::user()->medico->plan != "plan_profesional" and Auth::user()->medico->plan != "plan_platino"){
                  return app();
              }
          }

    });

    Blade::if('plan_profesional_no', function(){
        if(Auth::check() and Auth::user()->role == 'Asistente'){
            if(Auth::user()->assistant->medico->plan != "plan_profesional" and Auth::user()->assistant->medico->plan != "plan_platino"){
                return app();
            }


        }elseif(Auth::check() and Auth::user()->role == 'medico'){
            if(Auth::user()->medico->plan != "plan_profesional" and Auth::user()->medico->plan != "plan_platino"){
                return app();
            }
        }

  });

      Blade::if('plan_platino_no', function(){
          if(Auth::check() and Auth::user()->role == 'Asistente'){
              if(Auth::user()->assistant->medico->plan != "plan_platino"){
                  return app();
              }


          }elseif(Auth::check() and Auth::user()->role == 'medico'){
              if(Auth::user()->medico->plan != "plan_platino"){
                  return app();
              }
          }

    });

  }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
