<?php

namespace App\Http\Controllers;
use App\assistant;
use App\medico;
use App\User;
use App\medico_assistant;

use Mail;
use Illuminate\Http\Request;

class assistantController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function medico_assistants($id){
       $medico = medico::find($id);
       $medico_asistants = medico_assistant::where('medico_id', $id)->paginate(3);

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
        $user->save();

        $medico_asistants = new medico_assistant;
        $medico_asistants->medico_id = $request->medico_id;
        $medico_asistants->assistant_id = $assistant->id;
        $medico_asistants->save();

        $medico = medico::find($request->medico_id);

      //   Mail::send('mails.ActivationAssistent',['assistant'=>$assistant,'user'=>$user,'pass'=>$pass,'medico'=>$medico],function($msj) use($user){
      //      $msj->subject('Médicos Si');
      //      // $msj->to($user->email);
      //      $msj->to('eavc53189@gmail.com');
      //
      // });

      return redirect()->route('medico_assistants',$medico->id)->with('success', 'Se ha agregado un nuevo asistente, antes de que pueda asistirle debera asignarle los permisos necesarios.
      Se a enviado un mensaje al correo asociado, con los datos necearios para ingresar a su cuenta de asistente Médicossi.');



   }
}
