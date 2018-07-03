<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\medico;
use App\reminder;
use App\event;
use App\reminder_alarm;


class reminderCommand extends Command
{

      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'reminder:execute';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Command descriptions';

      /**
       * Create a new command instance.
       *
       * @return void
       */
      public function __construct()
      {
          parent::__construct();

      }

      /**
       * Execute the console command.
       *
       * @return mixed
       */
      public function handle()
      {
        $this->info('comando ejecutado');
        $reminder = reminder::where('type','Cita Confirmada')->where('days_before',1)->where('options','Si')->get();

        foreach ($reminder as $value) {
          $this->info($value->medico->name);
            $events = event::where('medico_id', $value->medico_id)->where('confirmed_medico','Si')->where('start','>',\Carbon\Carbon::now()->addDay()->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDay()->addHours(24))->where('state','!=','Rechazada/Cancelada')->where('state','!=','Pagada y Completada')->get();

            foreach ($events as $event) {
              $this->info($event->patient->email);
              Mail::send('mails.reminder',['event'=>$event],function($msj) use($event){
                 $msj->subject('Recordatorio Cita MédicosSi');
                 // $msj->to($event->patient->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }
        //VERIFICAR SI LA FUNCION ES addDays addDays addDays addDays addDays addDays
        $reminder = reminder::where('type','Cita Confirmada')->where('days_before',2)->where('options','Si')->get();

        foreach ($reminder as $value) {

            $events = event::where('medico_id', $value->medico_id)->where('confirmed_medico','Si')->where('start','>',\Carbon\Carbon::now()->addDays(2)->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDays(2)->addHours(24))->where('state','!=','Rechazada/Cancelada')->where('state','!=','Pagada y Completada')->get();

            foreach ($events as $event) {
              Mail::send('mails.reminder',['event'=>$event],function($msj) use($event){
                 $msj->subject('Recordatorio Cita MédicosSi');
                 // $msj->to($event->patient->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }

        //VERIFICAR SI LA FUNCION ES addDays addDays addDays addDays addDays addDays
        $reminder = reminder::where('type','Cita Confirmada')->where('days_before',4)->where('options','Si')->get();

        foreach ($reminder as $value) {

            $events = event::where('medico_id', $value->medico_id)->where('confirmed_medico','Si')->where('start','>',\Carbon\Carbon::now()->addDays(4)->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDays(4)->addHours(24))->where('state','!=','Rechazada/Cancelada')->where('state','!=','Pagada y Completada')->get();

            foreach ($events as $event) {
              Mail::send('mails.reminder',['event'=>$event],function($msj) use($event){
                 $msj->subject('Recordatorio Cita MédicosSi');
                 // $msj->to($event->patient->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }



        ///////////////////ALARMAS////////////////
        $this->info('recordatorios');

        $reminder = reminder::where('type','Alarma')->where('days_before',1)->where('options','Si')->get();

        foreach ($reminder as $value) {
          $this->info($value->medico->name);
            $recordatorio = reminder_alarm::where('medico_id', $value->medico_id)->where('start','>',\Carbon\Carbon::now()->addDay()->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDay()->addHours(24))->get();

            foreach ($recordatorio as $record) {
              $this->info($record->medico_id);
              $medico = medico::find($record->medico_id);
              Mail::send('mails.reminder_alarm',['record'=>$record,'medico'=>$medico],function($msj) use($medico,$record){
                 $msj->subject('Recordatorio MédicosSi para la fecha: '.\Carbon\Carbon::parse($record->start)->format('d-m-Y'));
                 // $msj->to($medico->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }


        $reminder = reminder::where('type','Alarma')->where('days_before',2)->where('options','Si')->get();

        foreach ($reminder as $value) {
          $this->info($value->medico->name);
            $recordatorio = reminder_alarm::where('medico_id', $value->medico_id)->where('start','>',\Carbon\Carbon::now()->addDay()->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDay()->addHours(24))->get();

            foreach ($recordatorio as $record) {
              $this->info($record->medico_id);
              $medico = medico::find($record->medico_id);
              Mail::send('mails.reminder_alarm',['record'=>$record,'medico'=>$medico],function($msj) use($medico,$record){
                $msj->subject('Recordatorio MédicosSi para la fecha: '.\Carbon\Carbon::parse($record->start)->format('d-m-Y'));
                 // $msj->to($medico->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }


        $reminder = reminder::where('type','Alarma')->where('days_before',4)->where('options','Si')->get();

        foreach ($reminder as $value) {
          $this->info($value->medico->name);
            $recordatorio = reminder_alarm::where('medico_id', $value->medico_id)->where('start','>',\Carbon\Carbon::now()->addDay()->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDay()->addHours(24))->get();

            foreach ($recordatorio as $record) {
              $this->info($record->medico_id);
              $medico = medico::find($record->medico_id);
              Mail::send('mails.reminder_alarm',['record'=>$record,'medico'=>$medico],function($msj) use($medico,$record){
                 $msj->subject('Recordatorio MédicosSi para: '.\Carbon\Carbon::parse($record->start)->format('d-m-Y H:i'));
                 // $msj->to($medico->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }

        ////////////////SOLO de PRUEBA
        $medico = medico::find(11);
        $medico->lastName = \Carbon\Carbon::now();
        $medico->save();
      }

}
