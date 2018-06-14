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
    return response()->json('ok');
  }

  public function reminder_time_confirmed(Request $request){


    $reminder = reminder::where('medico_id', $request->medico_id)->where('type','Cita Confirmada')->first();
    if($request->time == '1h'){
      $reminder->hours_before = 1;
      $reminder->days_before = Null;
    }elseif($request->time == '5h'){
      $reminder->hours_before = 5;
      $reminder->days_before = Null;
    }elseif ($request->time == '1d'){
      $reminder->days_before = 1;
      $reminder->hours_before = Null;
    }
    $reminder->save();
    return response()->json('ok');
  }

}
