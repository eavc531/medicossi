<?php

namespace App\Http\Controllers;
use Mail;
use App\reminder;
use App\medico;
use Illuminate\Http\Request;
use App\reminder_alarm;
//borrar
use App\event;

//
class reminderController extends Controller
{

    public function reminder_delete(Request $request){
      $reminder_alarm = reminder_alarm::find($request->reminder_id);
      $reminder_alarm->delete();
      return response()->json('ok');

    }

    public function reminder_alarm_update(Request $request){
          $request->validate([
            'title'=>'required',
            'description'=>'max:255',
            'date_start'=>'required',
            'hourStart'=>'required',
            'minsStart'=>'required',
          ]);

          // return response()->json('ok');
          //return response()->json($request->all());
          $hour_start1 = $request->hourStart.':'.$request->minsStart;
          $hour_end1 = $request->hourEnd.':'.$request->minsEnd;
          $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';
          $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        if($request->date_End == Null){
          $date_End = $request->date_start;
        }else{
          $date_End = $request->date_End;
        }

        if($request->hourEnd == '--' or $request->minsEnd == '--' or $request->hourEnd == Null or $request->minsEnd == Null){
          $hend = null;
          $mend = null;
          $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
          $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        }else{
          $hend = $request->hourEnd;
          $mend = $request->minsEnd;
          $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
          $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
        }


        $day1 = \Carbon\Carbon::parse($start)->dayOfWeek;

        $hour_start2 = \Carbon\Carbon::parse($start)->format('H:i');
        $hour_end2 = \Carbon\Carbon::parse($end)->format('H:i');

        if($day1 == 1){
          $day = 'lunes';
        }
        if($day1 == 2){
          $day = 'martes';
        }
        if($day1 == 3){
          $day = 'miercoles';
        }
        if($day1 == 4){
          $day = 'jueves';
        }
        if($day1 == 5){
          $day = 'viernes';
        }
        if($day1 == 6){
          $day = 'sabado';
        }
        if($day1 == 0){
          $day = 'domingo';
        }


        $comprobar_horario = reminder_alarm::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

        $comprobar_horario2 = reminder_alarm::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

        if($comprobar_horario == 0 or $comprobar_horario2 == 0){
          return response()->json('fuera del horario');
        }

        $reminder_alarm = reminder_alarm::find($request->event_id);

        if($reminder_alarm->start != $start){
          $comprobar_disponibilidad = reminder_alarm::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',$start)->where('end','>',$start)->where('state','!=','Rechazada/Cancelada')->count();

         $comprobar_disponibilidad2 = reminder_alarm::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',$end)->where('state','!=','Rechazada/Cancelada')->count();

         if($comprobar_disponibilidad != 0 or $comprobar_disponibilidad2 != 0){
           return response()->json('ya existe');
         }
        }






       //$reminder_alarm->title
       $reminder_alarm->start = $start;
       $reminder_alarm->end = $end;
       $reminder_alarm->save();

       return response()->json('ok');
    }

    public function reminder_store(Request $request)
    {
      $request->validate([

        'date_start'=>'required',
        'hourStart'=>'required',
        'minsStart'=>'required',

      ]);


      if($request->title == Null){
        $title = 'Recordatorio';
      }else{
        $title = $request->title;
      }
      //return response()->json($request->all());
      $hour_start1 = $request->hourStart.':'.$request->minsStart;

      $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

      $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';

      $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';


    if($request->date_End == Null){
      $date_End = $request->date_start;
    }else{
      $date_End = $request->date_End;
    }

    if($request->hourEnd == '--' or $request->minsEnd == '--' or $request->hourEnd == Null or $request->minsEnd == Null){
      $hend = null;
      $mend = null;
      $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
      $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

    }else{
      $hend = $request->hourEnd;
      $mend = $request->minsEnd;
      $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
      $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
    }


    $day1 = \Carbon\Carbon::parse($start)->dayOfWeek;

    $hour_start2 = \Carbon\Carbon::parse($start)->format('H:i');
    $hour_end2 = \Carbon\Carbon::parse($end)->format('H:i');

    if($day1 == 1){
      $day = 'lunes';
    }
    if($day1 == 2){
      $day = 'martes';
    }
    if($day1 == 3){
      $day = 'miercoles';
    }
    if($day1 == 4){
      $day = 'jueves';
    }
    if($day1 == 5){
      $day = 'viernes';
    }
    if($day1 == 6){
      $day = 'sabado';
    }
    if($day1 == 0){
      $day = 'domingo';
    }


    $comprobar_horario = reminder_alarm::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();


    $comprobar_horario2 = reminder_alarm::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

    if($comprobar_horario == 0 or $comprobar_horario2 == 0){
      return response()->json('fuera del horario');
    }

    $comprobar_disponibilidad = reminder_alarm::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',$start)->where('end','>',$start)->where('state','!=','Rechazada/Cancelada')->count();

   $comprobar_disponibilidad2 = reminder_alarm::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',$end)->where('state','!=','Rechazada/Cancelada')->count();


   if($comprobar_disponibilidad != 0 or $comprobar_disponibilidad2 != 0){
     return response()->json('ya existe');
   }

   $reminders = new reminder_alarm;
   $reminders->medico_id = $request->medico_id;
   $reminders->title = $title;
   $reminders->description =  $request->description;
   $reminders->start =  $start;
   $reminders->end =  $end;
   $reminders->state = 'Pendiente';
   $reminders->color = 'rgba(250, 61, 35, 0.95)';
   $reminders->save();

   return response()->json('ok');

    }

    public function reminder_calendar($id)
    {
      $reminders = reminder_alarm::where('medico_id',$id)->get();

      return response()->json($reminders);
    }


    public function medico_reminders($id)
    {
      // $months = month::where('user_id',Auth::user()->id)->get();
      $medico = medico::find($id);

      $lunes = event::where('medico_id',$id)->where('title','lunes')->orderBy('end','asc')->get();
      $martes = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->get();
      $miercoles = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->get();
      $jueves = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->get();
      $viernes = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->get();
      $sabado = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->get();
      $domingo = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->get();

      // event::max('');
      $countEventSchedule = event::where('medico_id',$id)->where('eventType','horario')->max('end');
      $reminder_alarm = reminder::where('medico_id',$id)->where('type','Alarma')->first();


      if($countEventSchedule != 0){

        $lunes1 = event::where('medico_id',$id)->where('title','lunes')->max('end');
        $martes1 = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->max('end');
        $miercoles1 = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->max('end');
        $jueves1 = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->max('end');
        $viernes1 = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->max('end');
        $sabado1 = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->max('end');
        $domingo1 = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->max('end');

        $max_hour = max($lunes1,$martes1,$miercoles1,$jueves1,$viernes1,$sabado1,$domingo1);

        $lunes2 = event::where('medico_id',$id)->where('title','lunes')->min('start');
        $martes2 = event::where('medico_id',$id)->where('title','martes')->min('start');
        $miercoles2 = event::where('medico_id',$id)->where('title','miercoles')->min('start');
        $jueves2 = event::where('medico_id',$id)->where('title','jueves')->min('start');
        $viernes2 = event::where('medico_id',$id)->where('title','viernes')->min('start');
        $sabado2 = event::where('medico_id',$id)->where('title','sabado')->min('start');
        $domingo2 = event::where('medico_id',$id)->where('title','domingo')->min('start');

        $array = [$lunes2,$martes2,$miercoles2,$jueves2,$viernes2,$sabado2,$domingo2];
        $array = array_diff($array, array(null));
        $min_hour = min($array);

        $lunes3 = event::where('medico_id',$id)->where('title','lunes')->count();
        if($lunes3 == 0){
          $lunes3 = 1;
        }else{
          $lunes3 = null;
        }

        $martes3 = event::where('medico_id',$id)->where('title','martes')->count();
        if($martes3 == 0){
          $martes3 = 2;
        }else{
          $martes3 = null;
        }

        $miercoles3 = event::where('medico_id',$id)->where('title','miercoles')->count();
        if($miercoles3 == 0){
          $miercoles3 = 3;
        }else{
          $miercoles3 = null;
        }
        $jueves3 = event::where('medico_id',$id)->where('title','jueves')->count();
        if($jueves3 == 0){
          $jueves3 = 4;
        }else{
          $jueves3 = null;
        }
        $viernes3 = event::where('medico_id',$id)->where('title','viernes')->count();
        if($viernes3 == 0){
          $viernes3 = 5;
        }else{
          $viernes3 = null;
        }
        $sabado3 = event::where('medico_id',$id)->where('title','sabado')->count();
        if($sabado3 == 0){
          $sabado3 = 6;
        }else{
          $sabado3 = null;
        }
        $domingo3 = event::where('medico_id',$id)->where('title','domingo')->count();
        if($domingo3 == 0){
          $domingo3 = 0;
        }else{
          $domingo3 = null;
        }

        $days_hide = ['lunes'=>$lunes3,'martes'=>$martes3,'miercoles'=>$miercoles3,'jueves'=>$jueves3,'viernes'=>$viernes3,'sabado'=>$sabado3,'domingo'=>$domingo3];
        //Configuración para recordatorio cita confirmada
        $reminder_confirmed = reminder::where('medico_id',$medico->id)->where('type', 'Cita Confirmada')->first();
         //Configuración para citas pagadas con fecha pasada
        $config_past_and_payment_auto = reminder::where('medico_id',$medico->id)->where('type', 'Pasada y Pagada')->first();

        return view('medico.panel.medico_reminders')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('reminder_alarm', $reminder_alarm);

      }

      return view('medico.panel.medico_reminders')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('reminder_alarm', $reminder_alarm);
      // ->with($months, 'months');
  }

  public function test(){
    $reminder = reminder::where('type','Cita Confirmada')->where('days_before',1)->where('options','Si')->get();
    foreach ($reminder as $value) {

        $events = event::where('medico_id', $value->medico_id)->where('confirmed_medico','Si')->where('start','>',\Carbon\Carbon::now()->addDay()->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDay()->addHours(24))->where('state','!=','Rechazada/Cancelada')->get();
        dd($events);
        foreach ($events as $event) {
          Mail::send('mails.reminder',['event'=>$event],function($msj) use($event){
             $msj->subject('Recordatorio Cita MédicosSi');
             $msj->to($event->patient->email);
             //$msj->to('eavc53189@gmail.com');
           });

        }
    }
  }

  public function reminder_switch_confirmed(Request $request){

    $count = reminder::where('medico_id', $request->medico_id)->where('type','Cita Confirmada')->count();

    if($count == 0){
      $reminder = new reminder;
      $reminder->type = 'Cita Confirmada';
      $reminder->medico_id = $request->medico_id;
      $reminder->options = 'Si';
      $reminder->save();
    }else{
      $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Cita Confirmada')->first();
      if($reminder->options == 'Si'){
          $reminder->options = 'No';
      }else{
          $reminder->options = 'Si';
      }

      $reminder->save();
    }
    return response()->json($reminder->options);
  }

  public function reminder_time_confirmed(Request $request){

    $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Cita Confirmada')->first();

    $reminder->times_before = $request->time;
    $reminder->save();
  }


  public function config_acvtivate_reminder_alarm(Request $request){

    $count = reminder::where('medico_id', $request->medico_id)->where('type','Alarma')->count();

    if($count == 0){
      $reminder = new reminder;
      $reminder->type = 'Alarma';
      $reminder->medico_id = $request->medico_id;
      $reminder->options = $request->options;
      $reminder->save();
    }else{
      $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Alarma')->first();
      $reminder->options = $request->options;
      $reminder->save();
    }
    return response()->json('ok2');
  }



  public function reminder_time_alarm(Request $request){

    $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Alarma')->first();
    $reminder->days_before = $request->time;
    $reminder->save();
    return response()->json('ok2');
  }

  public function switch_payment_and_past(Request $request){

    $count = reminder::where('medico_id', $request->medico_id)->where('type','Pasada y Pagada')->count();

    if($count == 0){
      $reminder = new reminder;
      $reminder->type = 'Pasada y Pagada';
      $reminder->medico_id = $request->medico_id;
      $reminder->options = 'Si';
      $reminder->save();
    }else{
      $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Pasada y Pagada')->first();
      if($reminder->options == 'Si'){
          $reminder->options = 'No';
      }else{
          $reminder->options = 'Si';
      }
      $reminder->save();
    }
    return response()->json('ok');
  }



}
