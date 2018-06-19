<?php

namespace App\Http\Controllers;
use Mail;
use App\reminder;
use App\medico;
use Illuminate\Http\Request;

//borrar
use App\event;

//
class reminderController extends Controller
{



    public function reminders_medico($id)
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

        return view('medico.reminders_medico')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('reminder_confirmed', $reminder_confirmed)->with('config_past_and_payment_auto', $config_past_and_payment_auto);

      }

      return view('medico.reminders_medico')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('config_past_and_payment_auto', $config_past_and_payment_auto);
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
             // $msj->to($event->patient->email);
             $msj->to('eavc53189@gmail.com');
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
      $reminder->options = $request->options;
      $reminder->save();
    }else{
      $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Cita Confirmada')->first();
      $reminder->options = $request->options;
      $reminder->save();
    }
    return response()->json('ok1');
  }

  public function reminder_time_confirmed(Request $request){


    $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Cita Confirmada')->first();
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
      $reminder->options = $request->options;
      $reminder->save();
    }else{
      $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Pasada y Pagada')->first();
      $reminder->options = $request->options;
      $reminder->save();
    }
    return response()->json('ok');
  }



}
