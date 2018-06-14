<?php

namespace App\Http\Controllers;
use App\assistant;
use App\medico;
use App\User;
use Mail;
use Illuminate\Http\Request;

class assistantController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */



   public function successRegAssistant($id)
   {
     $user = User::find($id);
     $assistant = assistant::find($user->assistant_id);
     return view('assistant.successReg')->with('assistant', $assistant);
   }

   public function AvisoConfirmAccountAssistant($id)
   {
     $user = User::find($id);
     $assistant = assistant::find($user->assistant_id);
     return view('assistant.AvisoConfirmAccountAssistant')->with('assistant', $assistant)->with('user', $user);
   }

  public function index()
  {
    $assistants = assistant::orderBy('id','desc')->paginate(10);

    return view('assistant.assistantList')->with('assistants', $assistants);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $medico = medico::orderBy('name','asc')->pluck('name','id');
      return view('assistant.create')->with('medico', $medico);
  }

  public function confirmAssistant($id,$code){
   $user = User::find($id);

   if($user->confirmation_code == $code){

       $user->confirmation_code = null;
       $user->confirmed = 'medium';
       $user->save();
       $assistant = assistant::where('user_id',$user->id);

       return redirect()->route('AvisoConfirmAccountAssistant',$user->id);
     }else{
       return redirect()->route('successRegAssistant',$user->id)->with('warning', 'No se pudo verificar la autenticacion del usuario,por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');

     }

  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {


        $request->validate([
          'identification'=>'required',
          'name'=>'required',
          'lastName'=>'required',
          'medico_id'=>'required',
          'phone1'=>'required',
          'phone2'=>'nullable',
          'email'=>'required|unique:users|unique:assistants',
          'password'=>'required',
        ]);

        $assistant = new assistant;
        $assistant->fill($request->all());
        $assistant->save();

        $code = str_random(25);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->assistant_id = $assistant->id;
        $user->confirmation_code = $code;
        $user->role = 'Asistente';
        $user->save();

      //   Mail::send('mails.ActivationAssistent',['assistant'=>$assistant,'user'=>$user,'code'=>$code],function($msj){
      //      $msj->subject('Médicos Si');
      //      $msj->to('eavc53189@gmail.com');
      //
      // });

      return redirect()->route('successRegAssistant',$user->id)->with('success', 'Se ha enviado un mensaje de confirmación a tu Correo Electronico.')->with('user', $user);



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
      $category = specialtyCategories::find($id);
      return view('specialty.specialtyCategories.edit')->with('category', $category);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $category = specialtyCategories::find($id);

    if($request->name != $category->name){
      $request->validate([
        'name'=>'required|unique:specialty_categories',
        'description'=>'nullable',
      ]);
    }
      $category->fill($request->all());

      $category->save();


      return redirect()->route('specialty_categories.index')->with('success','La Categoria: '.$request->name. ' ha sido actualizada.' );


  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
