<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\month;
use Auth;
use App\medico;
use App\patient;
use App\event;
use App\patients_doctor;
use Mail;
use App\reminder;
use App\reminder_alarm;
use App\data_patient;
use App\task_consultation;
use DB;
class medico_diaryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function search_patients_diary(Request $request){

        $patients = DB::table('patients_doctors')
        ->Join('medicos', 'patients_doctors.medico_id', '=', 'medicos.id')
        ->Join('patients', 'patients_doctors.patient_id', '=', 'patients.id')
        ->select('patients.*')
        ->where(function($query) use($request){
            $query->where('medico_id',$request->medico_id)
            ->where('patients.name','LIKE','%'.$request->search.'%');
        })->orWhere(function($query) use($request){
            $query->where('medico_id',$request->medico_id)
            ->where('patients.lastName','LIKE','%'.$request->search.'%');
        })->orWhere(function($query) use($request){
            $query->where('medico_id',$request->medico_id)
            ->where('patients.identification','LIKE','%'.$request->search.'%');
        })->get();

        $medico_id = $request->medico_id;

        return view('medico.panel.ajax_result_search',compact('patients','medico_id'));


    }

    public function confirmed_payment_app(Request $request){
        $event = event::find($request->event_id);
        $event->payment_state = 'Si';
        $event->price = $request->price;
        $event->state = 'Pagada y Pendiente';
        $event->confirmed_medico = 'Si';
        $event->confirmed_patient = 'Si';
        // return response()->json('ok');
        $event->color = 'rgb(233, 21, 21)';
        $event->save();
        return response()->json('ok');
    }

    public function confirmed_completed_app(Request $request){

        if($request->consultation == 'si'){
            $medico = medico::find($request->medico_id);
            $medico->event_id = Null;
            $medico->save();
        }
        $event = event::find($request->event_id);
        $event->payment_state = 'Si';
        $event->price = $request->price;
        $event->state = 'Pagada y Completada';
        $event->confirmed_medico = 'Si';
        $event->confirmed_patient = 'Si';
        // return response()->json('ok');
        $event->color = 'rgb(255, 255, 255)';
        $event->save();

        if($request->consultation == 'si'){
            return response()->json('redirect_agenda');
        }
        return response()->json('ok');
    }

    public function verify_change_date(Request $request){
        $event = event::find($request->event_id);
        if(\Carbon\Carbon::parse($event->start)->format('m-d-Y') != \Carbon\Carbon::parse($request->dateStart)->format('m-d-Y') or \Carbon\Carbon::parse($event->start)->format('H') !=  $request->hourStart or \Carbon\Carbon::parse($event->start)->format('i') != $request->minsStart){
            return response()->json('cambio fecha');
        }else{
            return response()->json('no cambio');
        }

    }

    // public function appointment_cancel(Request $request,$id)
    // {
    //     dd($request->all());
    //     $event = event::find($id);
    //     $event->state = 'Rechazada/Cancelada';
    //     $event->color = 'rgb(139, 139, 139)';
    //     $event->save();
    //     $medico = medico::find($event->medico_id);
    //     $patient = patient::find($event->patient_id);
    //
    //     $count_event = event::where('medico_id',$medico->id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->where('state','!=','Pagada y Completada')->whereNull('rendering')->count();
    //     $medico->notification_number = $count_event;
    //     $medico->event_id = Null;
    //
    //     $medico->save();
    //
    //
    //     Mail::send('mails.cancel_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($medico){
    //         $msj->subject('Notificación Cancelacion de Cita, MédicosSi');
    //         $msj->to($patient->email);
    //         // $msj->to('eavc53189@gmail.com');
    //     });
    //
    //     if(request()->ajax){
    //         return response()->json(['danger'=>'Se a Rechazado/Cancelado la cita '.$event->title.' '.$event->start.' con el paciente: '.$event->namePatient]);
    //     }else{
    //         return redirect()->route('medico_diary',\Hashids::encode($medico->id))->with('danger','Se a Rechazado/Cancelado la cita '.$event->title.' '.$event->start.' con el paciente: '.$event->namePatient);
    //     }
    //
    //
    // }
    //de tipo post la enterior es get
    public function cancel_appointment(Request $request)
    {
        $event = event::find($request->event_id);
        $event->state = 'Rechazada/Cancelada';
        $event->color = 'rgb(139, 139, 139)';
        $event->save();

        $medico = medico::find($event->medico_id);
        $medico->event_id = Null;
        $medico->save();

        $patient = patient::find($event->patient_id);

        if($event->namePatient == Null){
            return response()->json('xxxx');

            return response()->json('Se ha Rechazado/Cancelado el evento estipulado para la fecha: '.$event->start );
        }

        if($request->send == 'enviar'){
            Mail::send('mails.cancel_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($patient){
                $msj->subject('Notificación Cancelacion de Cita, MédicosSi');
                $msj->to($patient->email);
                // $msj->to('eavc53189@gmail.com');
            });

            if(request()->ajax){
                return response()->json('Se ha Rechazado/Cancelado la cita con el paciente: '.$event->namePatient.' estipulada para la fecha: '.$event->start.' y se le a enviado una notificacion a su correo, Las citas canceladas no se muestran en el calendario, es posible acceder a estas en el panel citas/citas canceladas.');
            }else{
                return redirect()->route('medico_diary',\Hashids::encode($medico->id))->with('danger', 'Se ha Rechazado/Cancelado la cita con el paciente: '.$event->namePatient.' estipulada para la fecha: '.$event->start.' y se le a enviado una notificacion a su correo, Las citas canceladas no se muestran en el calendario, es posible acceder a estas en el panel citas/citas canceladas.');
            }

        }


        if(request()->ajax){
            return response()->json('Se ha Rechazado/Cancelado la cita con el paciente: '.$event->namePatient.' estipulada para la fecha: '.$event->start.'. Las citas canceladas no se muestran en el calendario, es posible acceder a estas en el panel citas/citas canceladas.');
        }else{
            return redirect()->route('medico_diary',\Hashids::encode($medico->id))->with('danger','Se ha Rechazado/Cancelado la cita con el paciente: '.$event->namePatient.' estipulada para la fecha: '.$event->start.'. Las citas canceladas no se muestran en el calendario, es posible acceder a estas en el panel citas/citas canceladas.');
        }

    }

    public function appointment_confirm($id)
    {
        $event = event::find($id);

        if($event->start < \Carbon\Carbon::now()->format('Y-m-d H:i')){
            return back()->with('warning', 'Imposible Confirmar Cita, la fecha de esta cita: '.\Carbon\Carbon::parse($event->start)->format('d-m-Y H:i') .' ya paso, para confirmarla debera editar su fecha a una posterior.');
        }
        $medico = medico::find($event->medico_id);
        $event->confirmed_medico = 'Si';
        $event->save();

        $patient = patient::find($event->patient_id);
        $count_notifications = event::where('medico_id',$medico->id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->where('state','!=','Pagada y Completada')->whereNull('rendering')->count();
        $medico->notification_number = $count_notifications;
        $medico->save();

        Mail::send('mails.appointment_confirmed_by_medico',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($patient){
            $msj->subject('Notificación Cita Médicossi Confirmada, Médicos Si');
            $msj->to($patient->email);
            // $msj->to('eavc53189@gmail.com');
        });

        return redirect()->route('appointments',\Hashids::encode($event->medico_id))->with('success', 'Se a confirmado la cita con el paciente: '.$event->patient->name.' '.$event->patient->lastName.' para la Fecha: '.\Carbon\Carbon::parse($event->start)->format('d-m-Y H:i').' de forma simultanea se ha enviado un correo al paciente para notificarle de la confirmación');
    }




    public function appointment_confirm_ajax(Request $request)
    {


        $event = event::find($request->event_id);
        if($event->start < \Carbon\Carbon::now()->format('Y-m-d H:i')){
            return response()->json('fecha_pasada');
        }else{
            return response()->json('ok');
        }
        $event->confirmed_medico = 'Si';
        $event->save();

        $medico = medico::find($event->medico_id);
        $patient= patient::find($event->patient_id);


        Mail::send('mails.appointment_confirmed_by_medico',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($patient){
            $msj->subject('Notificación Cambio de Fecha de Cita, Médicos Si');
            $msj->to($patient->email);
            // $msj->to('eavc53189@gmail.com');
        });

        $count_notifications = event::where('medico_id',$medico->id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->where('state','!=','Pagada y Completada')->whereNull('rendering')->count();
        $medico->notification_number = $count_notifications;
        $medico->save();

        return response()->json('Se a confirmado la cita con el paciente: '.$event->patient->name.' '.$event->patient->lastName.' para la Fecha: '.$event->start.' de forma simultanea se le a enviado un correo para notificarle.');
    }


    public function event_personal_update(Request $request)
    {

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

        $event = event::find($request->event_id);
        ////////////////
        if($start > $end){
            return response()->json(['message'=>['error'=>'end menor start','message_error'=>'end menor start']]);
        }
        //Verificar FECHA ACTUALIZADA

        $day1 = \Carbon\Carbon::parse($start)->dayOfWeek;
        // / return response()->json('aqui');
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


        $comprobar_horario = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

        $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

        if($comprobar_horario == 0 or $comprobar_horario2 == 0){
            return response()->json(['message'=>['error'=>'fuera del horario','message_error'=>'fuera del horario']]);
        }

        if($event->start != $start){
            $comprobar_disponibilidad = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',\Carbon\Carbon::parse($start)->format('Y-m-d H:i'))->where('end','>',$start)->where('state','!=','Rechazada/Cancelada')->count();

            if($comprobar_disponibilidad != 0){
                return response()->json(['message'=>['error'=>'ya existe','message_error'=>'ya existe']]);
            }
        }

        if($event->end != $end){
            $comprobar_disponibilidad2 = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',\Carbon\Carbon::parse($end)->format('Y-m-d H:i'))->where('state','!=','Rechazada/Cancelada')->count();

            if($comprobar_disponibilidad2 != 0){
                return response()->json(['message'=>['error'=>'ya existe','message_error'=>'ya existe']]);

            }

        }


        $event->title = $request->title;
        $event->start = $start;
        $event->end = $end;
        $event->dateStart = $request->date_start;
        $event->dateEnd = $date_End;
        $event->description = $request->description;
        $event->save();

        return response()->json(['message'=>['error'=>'ok','message_error'=>'ok']]);
    }


    public function event_personal_delete(Request $request){
        $event = event::find($request->event_id);
        $event->delete();
        return response()->json('ok');
    }

    public function update_event(Request $request)
    {
        // dd($request->all());
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

        $event = event::find($request->event_id);
        ////////////////

        if($start > $end){
            if($request->ajax())
            {
                return response()->json(['message'=>['error'=>'end menor start','message_error'=>'end menor start']]);
            }else{
                return back()->with('warning', 'la fecha de inicio no debe ser mayor a la fecha de culminacion.');
            }


        }

        //Verificar FECHA ACTUALIZADA
        if($event->confirmed_medico != 'Si'){
            if($start < \carbon\carbon::now()){
                if($request->ajax())
                {
                    return response()->json(['message'=>['error'=>'fecha_pasada','message_error'=>'La fecha de inico de la Cita ha pasado, por favor agregue una fecha valida e intente nuevamente para poder confirmar la cita.']]);
                }else{
                    return back()->with('warning', 'La fecha de inico de la Cita ha pasado, por favor agregue una fecha valida e intente nuevamente para poder confirmar la cita.');
                }

            }
            $confirmando_cita = 'si';
        }else{
            $confirmando_cita = 'no';
        }





        ///////


        $day1 = \Carbon\Carbon::parse($start)->dayOfWeek;

        // / return response()->json('aqui');
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


        $comprobar_horario = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

        $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

        if($comprobar_horario == 0 or $comprobar_horario2 == 0){
            if($request->ajax())
            {
                return response()->json(['message'=>['error'=>'fuera del horario','message_error'=>'fuera del horario']]);
            }else{
                return back()->with('warning', 'Imposible Guardar, la fecha esta fuera del horario establecido.');
            }

        }


        //////////////////////////////////////////
        if($event->start != $start){
            $comprobar_disponibilidad = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',\Carbon\Carbon::parse($start)->format('Y-m-d H:i'))->where('end','>',$start)->where('state','!=','Rechazada/Cancelada')->count();

            if($comprobar_disponibilidad != 0){
                if($request->ajax())
                {
                    return response()->json(['message'=>['error'=>'ya existe','message_error'=>'ya existe']]);

                }else{
                    return back()->with('warning', 'Imposible realizar acción, Ya existe una cita en el horario que intenta guardar.');
                }


            }
        }

        if($event->end != $end){
            $comprobar_disponibilidad2 = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',\Carbon\Carbon::parse($end)->format('Y-m-d H:i'))->where('state','!=','Rechazada/Cancelada')->count();

            if($comprobar_disponibilidad2 != 0){
                if($request->ajax())
                {
                    return response()->json(['message'=>['error'=>'ya existe','message_error'=>'ya existe']]);
                }else{
                    return back()->with('warning', 'Imposible realizar acción, Ya existe una cita en el horario que intenta guardar.');
                }


            }

        }

        $before_date = $event->start;
        // return response()->json(['message'=>['error'=>$start]]);
        $event->title = $request->title;
        $event->start = $start;
        $event->end = $end;
        $event->payment_method = $request->payment_method;
        $event->dateStart = $request->date_start;
        $event->dateEnd = $date_End;
        $event->confirmed_patient = $request->confirmed_patient;
        $event->price = $request->price;
        $event->description = $request->description;
        $event->confirmed_medico = 'Si';

        if($event->state != 'Pasada y sin realizar'){
            if($request->title == 'Cita por Internet'){
                $event->color = 'rgb(35, 44, 173)';
            }else{
                $event->color = 'rgb(69, 189, 39)';
            }
            if($request->state == 'Cerrada y Cobrada'){
                $event->color = 'rgb(247, 215, 43)';
            }elseif($request->state == 'pre-pagada'){
                $event->color = 'rgb(214, 50, 50)';
            }
        }


        $medico = medico::find($event->medico_id);

        //ESTO SE APLICA A FINALIZAR CITAS
        if($request->cerrar_cita == Null){

            $event->state = $request->state;
        }else{
            if($request->cerrar_cita == 'cerrar_pago_pendiente'){
                $event->state = 'Realizada y por cobrar';
                $event->color = 'rgb(246, 43, 244)';
                $event->save();
                $medico->event_id = Null;
                $medico->save();

                    return redirect()->route('medico_diary',\Hashids::encode($medico->id))->with('success','La cita:' .$event->title.' '.$event->start.', con el Paciente: '.$event->namePatient.' ha sido cerrada y marcada como "Realizada y por Cobrar".');


            }elseif($request->cerrar_cita == 'cerrar_completada') {
                $event->state = 'Pagada y Completada';
                $event->color = 'rgb(255, 255, 255)';
                $event->save();
                $medico->event_id = Null;
                $medico->save();

                    return redirect()->route('medico_diary',\Hashids::encode($medico->id))->with('success','La cita:' .$event->title.' '.$event->start.', con el Paciente: '.$event->namePatient.' ha sido cerrada y marcada como "Completada".');

            }




        }

        $event->medico_id = $request->medico_id;
        $event->save();

        $patient = patient::find($event->patient_id);


        $count_notifications = event::where('medico_id',$request->medico_id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->whereNull('rendering')->count();
        $medico->notification_number = $count_notifications;
        $medico->save();

        if($start != $before_date and $confirmando_cita == 'si'){

            $event->confirmed_patient == 'Si';
            $event->save();
            Mail::send('mails.med_notification_patient_appointment_change_confirm',['medico'=>$medico,'patient'=>$patient,'event'=>$event,'before_date'=>$before_date],function($msj) use($patient){
                $msj->subject('Notificación Cambio de Fecha de Cita, Médicos Si');
                $msj->to($patient->email);
                // $msj->to('eavc53189@gmail.com');
            });


            if($request->ajax()){
                if($request->ajax())
                {
                    return response()->json(['message'=>['error'=>'confirmado_editado','message_error'=>'confirmado_editado']]);

                }else{
                    return back()->with('success', 'La Cita ha sido confirmada y se han guardado los cambios de forma exitosa');
                }

            }

        }elseif($confirmando_cita == 'si'){

            $event->confirmed_patient == 'Si';
            $event->save();
            Mail::send('mails.appointment_confirmed_by_medico',['medico'=>$medico,'patient'=>$patient,'event'=>$event,'before_date'=>$before_date],function($msj) use($patient){
                $msj->subject('Notificación Cambio de Fecha de Cita, Médicos Si');
                $msj->to($patient->email);
                // $msj->to('eavc53189@gmail.com');
            });

            if($request->ajax()){
                return response()->json(['message'=>['error'=>'cita_confirmada','message_error'=>'La Cita ha sido confirmada con exito. De forma simultanea se ha enviado un mensaje para notificarle al paciente sobre esta acción.']]);
            }else{
                return back()->with('success', 'La Cita ha sido confirmada con exito. De forma simultanea se ha enviado un mensaje para notificarle al paciente sobre esta acción.');
            }
        }



        if($request->ajax()){
            return response()->json(['message'=>['error'=>'ok','message_error'=>'ok']]);
        }


    }


    public function event_personal_store(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'date_start'=>'required',
            'hourStart'=>'required',
            'minsStart'=>'required',
            'hourEnd'=>'required',
            'minsEnd'=>'required',
        ]);

        $hour_start1 = $request->hourStart.':'.$request->minsStart;
        $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

        $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';
        $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';


        if($request->date_End == Null){
            $date_End = $request->date_start;
        }else{
            $date_End = $request->date_End;
        }

        if($request->hourEnd == Null or $request->minsEnd == Null){
            $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
            $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';
        }else{
            $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
            $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
        }

        if($start > $end){
            return response()->json('end menor start');
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

        $comprobar_horario = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

        $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

        if($comprobar_horario == 0 or $comprobar_horario2 == 0){
            return response()->json('fuera del horario');
        }



        $comprobar_disponibilidad = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',\Carbon\Carbon::parse($start)->format('Y-m-d H:i'))->where('end','>',$start)->where('state','!=','Rechazada/Cancelada')->count();

        if($comprobar_disponibilidad != 0){
            return response()->json('ya existe');

        }



        $comprobar_disponibilidad2 = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',\Carbon\Carbon::parse($end)->format('Y-m-d H:i'))->where('state','!=','Rechazada/Cancelada')->count();

        if($comprobar_disponibilidad2 != 0){
            return response()->json('ya existe');

        }




        // return response()->json($request->all());
        $event = new event;
        $event->medico_id = $request->medico_id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->confirmed_medico = 'Si';
        $event->start = $start;
        $event->end = $end;
        $event->state = 'personal';
        $event->color = 'rgb(68, 181, 230)';
        $event->save();

        return response()->json('ok');

    }
    public function medico_app_details($id,$p_id,$app_id){
        $app = event::find($app_id);
        return view('medico.patient.medico_app_details',compact('app'));
    }

    public function ajax_data_edit_event(Request $request){
        $event = event::find($request->event_edit);

        return response()->json($event);
    }


    public function edit_appointment($id,$p_id,$app_id)
    {
        $event_edit = event::find($app_id);
        $app = event::find($app_id);
        $medico = medico::find($id);
        $patient =  patient::find($p_id);

        ///////igual
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
            ///////igual

            return view('medico.appointments.edit')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('patient', $patient)->with('app', $app)->with('mode', 'edition')->with('event_edit',$event_edit);

        }
        return view('medico.appointments.edit')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('patient',$patient)->with('app', $app)->with('mode', 'edition')->with('event_edit',$event_edit);
        // ->with($months, 'months');
    }


    public function redirect_task_consultation(Request $request)
    {

        return redirect()->route('task_consultation',['m_id'=>\Hashids::encode($request->medico_id),'p_id'=>\Hashids::encode($request->patient_id),'app_id'=>\Hashids::encode($request->event_id)]);


    }

    public function task_consultation($m_id,$p_id,$app_id)
    {
        $event_edit = event::find($app_id);
        $tasks = task_consultation::where('event_id',$app_id)->paginate(10);
        $medico = medico::find($m_id);
        $patient = patient::find($p_id);
        return view('medico.appointments.details_consultation',compact('event_edit','tasks','medico','patient'));
    }


    public function ending_appointment($id,$p_id,$app_id)
    {

        if (Auth::user()->role == 'medico') {
            $tasks = task_consultation::where('event_id',Auth::user()->medico->event_id)->orderBy('id','desc')->paginate(10);

        }elseif(Auth::user()->role == 'Asistente'){

        }

        $event_edit = event::find(Auth::user()->medico->event_id);

        // dd(Auth::user()->medico->event_id);
        // dd($event_edit);
        $app = event::find($app_id);
        $medico = medico::find($id);
        $patient =  patient::find($p_id);

        ///////igual
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
            ///////igual
            // edita_asistente


            return view('medico.appointments.ending_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('patient', $patient)->with('app', $app)->with('mode', 'edition')->with('event_edit',$event_edit)->with('tasks',$tasks);

        }
        return view('medico.appointments.ending_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('patient',$patient)->with('app', $app)->with('mode', 'edition')->with('event_edit',$event_edit)->with('tasks',$tasks);
        // ->with($months, 'months');
    }





    public function medico_stipulate_appointment($id,$p_id)
    {

        // $months = month::where('user_id',Auth::user()->id)->get();
        $medico = medico::find($id);

        $patient =  patient::find($p_id);

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

            return view('medico.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('patient', $patient);

        }
        return view('medico.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('patient',$patient);
        // ->with($months, 'months');
    }

    public function appointment_store(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'date_start'=>'required',
            'hourStart'=>'required',
            'minsStart'=>'required',
            'hourEnd'=>'required',
            'minsEnd'=>'required',
            'payment_method'=>'required',
        ]);

        $hour_start1 = $request->hourStart.':'.$request->minsStart;
        $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

        $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';
        $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        if($request->date_End == Null){
            $date_End = $request->date_start;
        }else{
            $date_End = $request->date_End;
        }

        if($request->hourEnd == Null or $request->minsEnd == Null){
            $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
            $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        }else{
            $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
            $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
        }

        if($start > $end){
            return response()->json('end menor start');
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

        $comprobar_horario = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

        $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

        if($comprobar_horario == 0 or $comprobar_horario2 == 0){
            return response()->json('fuera del horario');
        }

        $comprobar_disponibilidad = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',\Carbon\Carbon::parse($start)->format('Y-m-d H:i'))->where('end','>',$start)->where('state','!=','Rechazada/Cancelada')->count();

        if($comprobar_disponibilidad != 0){
            return response()->json('ya existe');
        }

        $comprobar_disponibilidad2 = event::where('id','!=',$request->event_id)->where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',\Carbon\Carbon::parse($end)->format('Y-m-d H:i'))->where('state','!=','Rechazada/Cancelada')->count();

        if($comprobar_disponibilidad2 != 0){
            return response()->json('ya existe');

        }

        $event = new event;
        //$event->price = $request->price;
        $event->payment_method = $request->payment_method;

        if($request->payment_method == 'Pre-pagada'){
            if($request->price == Null){
                return response()->json('error_prepagada');
            }else{
                $event->payment_state = 'Si';
                $event->state = 'Pagada y Pendiente';
            }
        }
        // $event->description = $request->description;
        $event->title = $request->title;
        $event->start = $start;
        $event->end = $end;
        $event->dateStart = $request->date_start;
        $event->dateEnd = $date_End;
        $event->description = $request->description;
        $event->price = $request->price;

        if(Auth::check() and Auth::user()->role == 'Paciente'){

            $event->color = 'rgb(4, 47, 126)';
            $event->namePatient = Auth::user()->patient->name.' '.Auth::user()->patient->lastName;
            $event->patient_id = Auth::user()->patient->id;
            $event->medico_id = $request->medico_id;
            $patient = patient::find($request->patient_id);
            $event->namePatient = $patient->name.' '.$patient->lastName;
            $event->stipulated = "Paciente";
            $event->notification = "not_see";
            $event->confirmed_patient = 'Si';
        }elseif (Auth::check() and Auth::user()->role == 'medico' or Auth::check() and Auth::user()->role == 'Asistente') {

            if($event->title == 'Cita por Internet'){
                $event->color = 'rgb(4, 47, 126)';
            }elseif($request->payment_method == 'Pre-pagada'){
                $event->color = 'rgb(214, 50, 50)';
            }elseif($request->payment_method == 'Aseguradora') {
                $event->color = 'rgb(255, 152, 152)';
            }else{
                $event->color = 'rgb(69, 189, 39)';
            }


            $event->confirmed_medico = 'No';
            $event->patient_id = $request->patient_id;
            $event->medico_id = $request->medico_id;
            $patient = patient::find($request->patient_id);
            $event->namePatient = $patient->name.' '.$patient->lastName;
            $event->stipulated = "Medico";
        }
        $event->hour_start = $hourStart;
        $event->hour_end = $hourEnd;

        $medico = medico::find($request->medico_id);
        $patient = patient::find($request->patient_id);


        //////////////////registro por medico
        if(Auth::check() and Auth::user()->role == 'medico' or Auth::check() and Auth::user()->role == 'Asistente'){

            $event->confirmed_medico = 'Si';

            if($request->send == 'enviar'){

                Mail::send('mails.med_notification_patient_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($patient){
                    $msj->subject('Médicos Si');
                    $msj->to($patient->email);
                    // $msj->to('eavc53189@gmail.com');
                });
            }


            $event->save();
            if($request->send == 'enviar'){
                return response()->json('Se ha agendado Una Cita "'.$request->title.'" con el Paciente: '.$patient->name.' '.$patient->lastName.' para la fecha: '.$request->date_start.' y hora: '.$hourStart.'. y se le a enviado una notificacion a su correo.');
            }else{
                return response()->json('Se ha agendado Una Cita "'.$request->title.'" con el Paciente: '.$patient->name.' '.$patient->lastName.' para la fecha: '.$request->date_start.' y hora: '.$hourStart.'.');
            }

        }
        $event->save();

        $patients_doctorsCount = patients_doctor::where('patient_id',$request->patient_id)->where('medico_id',$request->medico_id)->count();

        if($patients_doctorsCount == 0){


            $data_patient = new data_patient;
            $data_patient->fill($patient->toArray());
            $data_patient->medico_id = $medico->id;
            $data_patient->patient_id = $patient->id;
            $data_patient->nameComplete = $request->name.' '.$request->lastName;
            $age =  \Carbon\Carbon::parse($request->birthdate)->diffInYears(\Carbon\Carbon::now());
            $data_patient->age = $age;
            $data_patient->save();

            $patients_doctors = new patients_doctor;
            $patients_doctors->patient_id = $request->patient_id;
            $patients_doctors->medico_id = $request->medico_id;
            $patients_doctors->data_patient_id = $data_patient->id;
            $patients_doctors->save();
        }

        $count_notifications = event::where('medico_id',$request->medico_id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->whereNull('rendering')->count();
        $medico->notification_number = $count_notifications;

        $medico->save();

        Mail::send('mails.app_stipulate_patient',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($medico){
            $msj->subject('Médicos Si');
            $msj->to($medico->email);
            // $msj->to('eavc53189@gmail.com');
        });


        return response()->json('Se ha agendado Una Cita "'.$request->title.'" con el Médico: '.$medico->name.' '.$medico->lastName.' para la fecha: '.$request->date_start.' y hora: '.$hourStart.'.');
    }

    public function stipulate_appointment($id)
    {

        $medico = medico::find($id);
        if($medico->plan != 'plan_profesional' and $medico->plan != 'plan_platino'){
            return back()->with('warning','La opcion de agendar citas online con el médico: "'.$medico->name.' '.$medico->lastName.'" estas desabilitadas en este momento,por favor intente contactarlo por otro medio o intente con otro médico, para los Médicos que poseen esta opcion habilitida  se muestra el boton "Agendar Cita" en color "Azul Claro".');
        }
        // $months = month::where('user_id',Auth::user()->id)->get();

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

            return view('patient.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule);

        }
        return view('patient.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule);
        // ->with($months, 'months');
    }

    public function medico_schedule($id)
    {
        $medico = medico::find($id);
        $lunes = event::where('medico_id',$id)->where('title', 'lunes')->orderBy('start','asc')->get();
        $martes = event::where('medico_id',$id)->where('title', 'martes')->orderBy('start','asc')->get();
        $miercoles = event::where('medico_id',$id)->where('title', 'miercoles')->orderBy('start','asc')->get();
        $jueves = event::where('medico_id',$id)->where('title', 'jueves')->orderBy('start','asc')->get();
        $viernes = event::where('medico_id',$id)->where('title', 'viernes')->orderBy('start','asc')->get();
        $sabado = event::where('medico_id',$id)->where('title', 'sabado')->orderBy('start','asc')->get();
        $domingo = event::where('medico_id',$id)->where('title', 'domingo')->orderBy('start','asc')->get();

        return view('medico.panel.schedule')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo);

    }

    public function medico_business_hours($id)
    {
        $data = event::where('medico_id',$id)->where('rendering', 'background')->get(['start','end','dow','color','hourStart','hourEnd','minsStart','minsEnd','id']);
        // return view('fullCalendar.fullCalendar');
        return Response()->json($data);
    }

    public function medico_diary($id)
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
        $config_past_and_payment_auto = reminder::where('medico_id',$medico->id)->where('type', 'Pasada y Pagada')->first();
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


            return view('medico.panel.diary')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('reminder_confirmed', $reminder_confirmed)->with('config_past_and_payment_auto', $config_past_and_payment_auto);

        }

        return view('medico.panel.diary')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('config_past_and_payment_auto', $config_past_and_payment_auto);
        // ->with($months, 'months');
    }

    public function verify_past_appointment($id){
        $verify_past_appointment = event::where('medico_id',$id)->where('end','<', \Carbon\Carbon::now())->where('confirmed_medico','Si')->where('state', 'Pendiente')->get();

        foreach ($verify_past_appointment as $value) {
            // $value->color = 'rgb(190, 61, 13)';
            $value->state = 'Pasada y sin realizar';
            $value->save();
        }
        // rgb(190, 61, 13)

    }


    public function verify_past_and_payment($id){
        $verify_config_past_and_payment = reminder::where('medico_id', $id)->where('type','Pasada y Pagada')->first();
        if($verify_config_past_and_payment != Null and $verify_config_past_and_payment->options == 'Si'){
            $event_past_and_payment = event::where('medico_id',$id)->where('end','<', \Carbon\Carbon::now())->where('state', 'Pagada y Pendiente')->get();

            foreach ($event_past_and_payment as $value) {
                $value->color = 'rgb(255, 255, 255)';
                $value->state = 'Pagada y Completada';
                $value->save();
            }

        }

    }
    public function patient_medico_diary_events($id){
        $datas = event::where('medico_id',$id)->where('state','!=','Rechazada/Cancelada')->get();

        $data = [];
        //ordenar array
        foreach ($datas as $dat){
            if($dat->rendering == 'background'){
                $data[] = ['title'=>$dat->title,'start'=>$dat->start,'end'=>$dat->end,'rendering'=>$dat->rendering,'dow'=>$dat->dow];
            }else{
                $data[] =
                ['title'=>$dat->title,'start'=>$dat->start,'end'=>$dat->end,'rendering'=>$dat->rendering,'dow'=>$dat->dow,'color'=>'rgb(230, 109, 64)'];

            }


        }



        return Response()->json($data);

    }

    public function medico_diary_events($id)
    {

        medico_diaryController::verify_past_appointment($id);
        medico_diaryController::verify_past_and_payment($id);

        $data = event::where('medico_id',$id)->where('state','!=','Rechazada/Cancelada')->get();

        return Response()->json($data);
    }

    public function medico_diary_fullscreen($id)
    {

        $medico = medico::find($id);
        return view('medico.diary.fullscreen')->with('medico', $medico);

    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function medico_schedule_delete($id){
        //day::destroy($id);
        $day = event::find($id);
        $day_reminder = reminder_alarm::where('event_id',$id)->first();
        if($day_reminder != Null){
            $day_reminder->delete();
        }

        $day->delete();

        return back()->with('danger', 'se a eliminado horas de la columna: '.$day->name);
    }

    public function medico_schedule_store(Request $request,$id)
    {
        $request->validate([
            'day'=>'required',
        ]);

        function add_schedule($data,$request){
            $dow = 0;

            foreach ($data as $i => $value){

                $schedule = new event;
                $dow = $dow + 1;
                $schedule->dow = $dow;
                $schedule->color = 'rgba(162, 231, 50, 0.64)';
                $schedule->rendering = 'background';
                $schedule->medico_id = $request->medico_id;
                $schedule->eventType = 'horario';
                $schedule->title = $value;
                $schedule->start = $request->hour_start.':'.$request->mins_start;
                $schedule->end = $request->hour_end.':'.$request->mins_end;

                $schedule->state = 'horario';
                $schedule->save();

                $schedule2 = new reminder_alarm;

                $schedule2->dow = $dow;
                $schedule2->color = 'rgba(162, 231, 50, 0.64)';
                $schedule2->rendering = 'background';
                $schedule2->medico_id = $request->medico_id;
                $schedule2->eventType = 'horario';
                $schedule2->title = $value;
                $schedule2->start = $request->hour_start.':'.$request->mins_start;
                $schedule2->end = $request->hour_end.':'.$request->mins_end;
                $schedule2->state = 'horario';
                $schedule2->event_id = $schedule->id;
                $schedule2->save();

            }
        }

        $start_verify = $request->hour_start.':'.$request->mins_start;
        $end_verify = $request->hour_end.':'.$request->mins_end;

        if($start_verify > $end_verify){
            return back()->with('warning','imposible guardar horas, la hora de incio debe ser menor a la hora de culminacion.');
        }


        if($request->day == 'lunes a jueves'){
            $data = array('lunes','martes','miercoles','jueves');
            add_schedule($data,$request);

            $day = $request->day;
            return back()->with('success', 'Se a han agregado nuevas horas a todos los dias desde:: '.$request->day)->with('day',$day);
        }

        if($request->day == 'lunes a viernes'){
            $data = array('lunes','martes','miercoles','jueves','viernes');
            add_schedule($data,$request);

            $day = $request->day;
            return back()->with('success', 'Se a han agregado nuevas horas a todos los dias desde:: '.$request->day)->with('day',$day);
        }

        if($request->day == 'lunes a sabado'){
            $data = array('lunes','martes','miercoles','jueves','viernes','sabado');
            $dow = 0;
            add_schedule($data,$request);
            $day = $request->day;
            return back()->with('success', 'Se a han agregado nuevas horas a todos los dias desde: '.$request->day)->with('day',$day);
        }

        if($request->day == 'lunes a domingo'){
            $data = array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');
            $dow = 0;
            add_schedule($data,$request);
            $day = $request->day;
            return back()->with('success', 'Se a han agregado nuevas horas a todos los dias desde: '.$request->day)->with('day',$day);
        }
        //dd($request->all());
        // $medicalCenter = medico::find($id);
        $schedule = new event;
        if($request->day == 'domingo'){
            $schedule->title = 'domingo';
            $schedule->dow = 0;

        }elseif($request->day == 'lunes'){

            $schedule->title = 'lunes';
            $schedule->dow = 1;

        }elseif($request->day == 'martes'){
            $schedule->title = 'martes';
            $schedule->dow = 2;

        }elseif($request->day == 'miercoles'){

            $schedule->title = 'miercoles';
            $schedule->dow = 3;

        }elseif($request->day == 'jueves'){
            $schedule->title = 'jueves';
            $schedule->dow = 4;

        }elseif($request->day == 'viernes'){
            $schedule->title = 'viernes';
            $schedule->dow = 5;

        }elseif($request->day == 'sabado'){
            $schedule->title = 'sabado';
            $schedule->dow = 6;

        }

        $schedule->color = 'rgba(162, 231, 50, 0.64)';
        $schedule->rendering = 'background';
        $schedule->medico_id = $id;
        $schedule->eventType = 'horario';
        $schedule->title = $request->day;
        $schedule->start = $request->hour_start.':'.$request->mins_start;
        $schedule->end = $request->hour_end.':'.$request->mins_end;
        $schedule->state = 'horario';
        $schedule->save();

        $schedule2 = new reminder_alarm;

        if($request->day == 'domingo'){
            $schedule2->title = 'domingo';
            $schedule2->dow = 0;

        }elseif($request->day == 'lunes'){
            $schedule2->title = 'lunes';
            $schedule2->dow = 1;

        }elseif($request->day == 'martes'){
            $schedule2->title = 'martes';
            $schedule2->dow = 2;

        }elseif($request->day == 'miercoles'){
            $schedule2->title = 'miercoles';
            $schedule2->dow = 3;

        }elseif($request->day == 'jueves'){
            $schedule2->title = 'jueves';
            $schedule2->dow = 4;

        }elseif($request->day == 'viernes'){
            $schedule2->title = 'viernes';
            $schedule2->dow = 5;

        }elseif($request->day == 'sabado'){
            $schedule2->title = 'sabado';
            $schedule2->dow = 6;

        }

        $schedule2->color = 'rgba(162, 231, 50, 0.64)';
        $schedule2->rendering = 'background';
        $schedule2->medico_id = $id;
        $schedule2->eventType = 'horario';
        $schedule2->title = $request->day;
        $schedule2->start = $request->hour_start.':'.$request->mins_start;
        $schedule2->end = $request->hour_end.':'.$request->mins_end;
        $schedule2->state = 'horario';
        $schedule2->event_id = $schedule->id;
        $schedule2->save();

        $day = $request->day;
        return back()->with('success', 'Se a han agregado nuevas horas al dia: '.$request->day)->with('day',$day);

    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function medico_business_hours_update(Request $request)
    {

        $request->validate([
            'hourStart'=>'required',
            'minsStart'=>'required',
            'hourEnd'=>'required',
            'minsEnd'=>'required',
        ]);
        //if($request->)
        $start = $request->hourStart.':'.$request->minsStart;
        $end = $request->hourEnd.':'.$request->minsEnd;
        $schedule = event::find($request->event_id);
        $schedule->start = $start;
        $schedule->end = $end;
        $schedule->save();

        return redirect()->route('medico_schedule',\Hashids::encode($request->medico_id))->with('success2','horas Editadas para el dia: '.$schedule->title);

    }


    public function update(Request $request, $id)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request,$id)
    {
        event::destroy($request->event_id);
        return back()->with('danger', 'Evento Eliminado con Exito');
    }



    public function delete_event2($id)
    {
        $event = event::find($id);
        event::destroy($id);

        return redirect()->route('medico_appointments_patient',['m_id'=>\Hashids::encode($event->medico_id),'p_id'=>\Hashids::encode($event->patient_id)])->with('danger','Se ha eliminado una Cita con el paciente: '.$event->medico->name.' '.$event->medico->lastName.' correspondiente a la fecha: '.$event->start);
    }

    public function compare_hours(Request $request,$id)
    {
        if($request->day == 1){
            $day = 'lunes';
        }

        if($request->day == 2){
            $day = 'martes';
        }
        if($request->day == 3){
            $day = 'miercoles';
        }
        if($request->day == 4){
            $day = 'jueves';
        }
        if($request->day == 5){
            $day = 'viernes';
        }
        if($request->day == 6){
            $day = 'sabado';
        }
        if($request->day == 0){
            $day = 'domingo';
        }

        $event = event::where('medico_id',$id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$request->hour_start)->where('end','>=',$request->hour_start)->count();

        $event2 = event::where('medico_id',$id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$request->hour_end)->where('end','>=',$request->hour_end)->count();

        if($event == 0 or $event2 == 0){
            return response()->json('fuera del horario');
        }else{
            return response()->json('ok');
        }


    }
}
