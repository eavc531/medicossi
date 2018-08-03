<?php

namespace App\Http\Controllers;
use App\assistant;
use App\medico;
use App\User;
use App\medico_assistant;
use App\permission;
use Mail;
use Auth;
use Illuminate\Http\Request;

class assistantController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
*/
    public function add_assistant_store(Request $request){

        $medico_assistant = medico_assistant::where('medico_id',$request->medico_id)->where('assistant_id', $request->assistant_id)->first();
        $assistant = assistant::find($request->assistant_id);

        if($medico_assistant == Null){
            $permission = new permission;
            $permission->save();

            $medico_assistant = new medico_assistant;
            $medico_assistant->medico_id = $request->medico_id;
            $medico_assistant->assistant_id = $request->assistant_id;
            $medico_assistant->permission_id = $permission->id;
            $medico_assistant->save();


            return redirect()->route('medico_assistants',$request->medico_id)->with('success', 'Se ha agregado "'.$assistant->nameComplete.'" a su lista de asistentes. Para que Pueda asistirle en los procesos de su cuenta de medico Médicossi, debera asignarle permisos.');
        }else{
            return back()->with('warning', '"'.$assistant->nameComplete.'" ya existe en su lista de Asistentes.');

        }


    }
    public function search_assistants_registered(Request $request){
        $medico = medico::find($request->medico_id);
        $assistants = assistant::where('nameComplete','LIKE','%'.$request->search.'%')->orWhere('identification','LIKE','%'.$request->search.'%')->paginate(10);
        $search = 'search';
        return view('assistant.add_assistant',compact('medico','assistants','search'));
    }

    public function add_assistant($id){
        $medico = medico::find($id);
        $assistants = assistant::paginate(10);
        return view('assistant.add_assistant',compact('medico','assistants'));
    }

    public function assistant_permissions_store(Request $request){

        $permission = permission::find($request->permission_id);
        
        $permission->cita_patient_create = $request->cita_patient_create;
        $permission->cita_person_create = $request->cita_person_create;
        $permission->cita_edit = $request->cita_edit;
        $permission->cita_refuse = $request->cita_refuse;
        $permission->cita_cancel = $request->cita_cancel;
        $permission->cita_change_date = $request->cita_change_date;
        $permission->cita_confirm = $request->cita_confirm;
        $permission->cita_confirm_payment = $request->cita_confirm_payment;
        $permission->cita_confirm_completed = $request->cita_confirm_completed;
        //recordatorios
        $permission->reminder_create = $request->reminder_create;
        $permission->reminder_delete = $request->reminder_delete;
        $permission->reminder_edit = $request->reminder_edit;
        //horario
        $permission->edit_schedule = $request->edit_schedule;
        //INGRESOS
        $permission->see_income = $request->see_income;
        //notes
        $permission->note_create = $request->note_create;
        $permission->note_config = $request->note_config;
        $permission->note_edit = $request->note_edit;
        $permission->note_delete = $request->note_delete;
        $permission->note_pdf = $request->note_pdf;
        $permission->note_move = $request->note_move;
        //expedient
        //plansController
        $permission->change_plan = $request->change_plan;
        //comentarios
        $permission->config_comment_show = $request->config_comment_show;
        $permission->config_comment = $request->config_comment;
        $permission->save();

        $assistant = assistant::find($request->assistant_id);

        return redirect()->route('medico_assistants',$request->medico_id)->with('success', 'Se han editado los Permisos para el Asistente: '.$assistant->nameComplete);
   }

   public function assist_medico(Request $request){
       $assistant = assistant::find(Auth::user()->assistant->id);
       $assistant->medico_id = $request->medico_id;
       $assistant->permission_id = $request->permission_id;
       $assistant->save();
       $medico = medico::find($request->medico_id);
       return back()->with('success', 'Ahora estas asistiendo al Médico: '.$medico->nameComplete.'. Podras comprobar el médico al que estas asistiendo en la barra  de navegacion, en todo momento.');
   }

   public function assistant_medicos($id){
       $assistant = assistant::find($id);
       $assistant_medicos = medico_assistant::where('assistant_id', $id)->paginate(10);
       $medico = medico::find($assistant_medicos->first()->medico_id);
       return view('assistant.medicos',compact('assistant_medicos','assistant','medico'));
   }


    public function assistant_permissions($id){
        $medico_assistant = medico_assistant::find($id);
        $assistant = assistant::find($medico_assistant->assistant_id);
        $medico = medico::find($medico_assistant->medico_id);
        $permissions = permission::find($medico_assistant->permission_id);

        return view('assistant.permissions',compact('medico_assistant','permissions','assistant','medico'));

    }
   public function medico_assistants($id){
       $medico = medico::find($id);
       $medico_asistants = medico_assistant::where('medico_id', $id)->paginate(10);
       // dd($medico_asistants);
       return view('assistant.index',compact('medico_asistants','medico'));
   }

   public function medico_assistant_create($id)
   {
       $medico = medico::find($id);
      return view('assistant.create',compact('medico'));
   }

   public function store(Request $request)
   {

        $request->validate([
          'identification'=>'required|unique:assistants',
          'name'=>'required',
          'lastName'=>'required',
          'phone1'=>'required',
          'phone2'=>'nullable',
          'email'=>'required|unique:users|unique:assistants',

        ]);

        $assistant = new assistant;
        $assistant->fill($request->all());

        $assistant->nameComplete = $request->name.' '.$request->lastName;
        $assistant->save();

        $pass = str_random(8);
        // $code = str_random(25);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($pass);
        $user->role = 'Asistente';
        $user->assistant_id = $assistant->id;
        $user->save();

        $permission = new permission;

        $permission->save();

        $medico_asistants = new medico_assistant;
        $medico_asistants->medico_id = $request->medico_id;
        $medico_asistants->assistant_id = $assistant->id;
        $medico_asistants->permission_id = $permission->id;
        $medico_asistants->save();

        $medico = medico::find($request->medico_id);

        Mail::send('mails.ActivationAssistent',['assistant'=>$assistant,'user'=>$user,'pass'=>$pass,'medico'=>$medico],function($msj) use($user){
           $msj->subject('Médicos Si');
           $msj->to($user->email);
           // $msj->to('eavc53189@gmail.com');

      });

      return redirect()->route('medico_assistants',$medico->id)->with('success', 'Se ha agregado un nuevo asistente, antes de que pueda asistirle debera asignarle los permisos necesarios.
      Se a enviado un mensaje al correo asociado, con los datos necearios para que pueda ingresar a su cuenta de asistente Médicossi.');

   }
}
