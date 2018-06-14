<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\medico;
use App\reminder;
use App\event;

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
        $reminder = reminder::where('type','Cita Confirmada')->where('days_before',1)->where('options','Si')->get();

        foreach ($reminder as $value) {

            $events = event::where('medico_id', $value->medico_id)->where('confirmed_medico','Si')->where('start','>',\Carbon\Carbon::now()->addDay()->addHours(1))->where('start','<',\Carbon\Carbon::now()->addDay()->addHours(24))->where('state','!=','Rechazada/Cancelada')->get();

            foreach ($events as $event) {
              Mail::send('mails.reminder',['event'=>$event],function($msj) use($event){
                 $msj->subject('Recordatorio Cita MédicosSi');
                 // $msj->to($event->patient->email);
                 $msj->to('eavc53189@gmail.com');
               });

            }
        }

        $medico = medico::find(11);
        $medico->lastName = 'lasttt';
        $medico->save();
      }
      
}
