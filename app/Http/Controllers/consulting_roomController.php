<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\consulting_room;
use App\medico;
use App\city;
use App\state;
class consulting_roomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('consulting_room.create');
    }

    public function consulting_room_update(Request $request,$id)
    {
      $request->validate([
        'type'=>'required',
        'state'=>'required',
        'city'=>'required',
        'colony'=>'required',
        'street'=>'required'
        // 'number_ext'=>'required',
      ]);

      if($request->type == 'Otro Especifique:'){
        if($request->otro == Null){
          return back()->with('warning', 'Debes especificar el tipo de Consultiorio');
        }
        $type_consulting_room = $request->otro;
      }else{
        $type_consulting_room = $request->type;
      }

       if($request->city == 'opciones'){
         return back()->with('warning', 'El campo ciudad es requerido')->withInput();
       }

      $consulting_room = consulting_room::find($id);
      $consulting_room->type = $type_consulting_room;
      $consulting_room->state = $request->state;
      $consulting_room->city = $request->city;
      $consulting_room->colony = $request->colony;
      $consulting_room->passwordUnique = $request->passwordUnique;
      $consulting_room->numberExt = $request->numberExt;
      $consulting_room->numberInt = $request->numberInt;
      $consulting_room->name = $request->name;


      $consulting_room->postal_code = $request->postal_code;
      $consulting_room->street = $request->street;
      $consulting_room->save();

        return redirect()->route('medico.edit',$consulting_room->medico_id)->with('success', 'Se han guardado los cambios para el consultorio de forma satisfactoria');
    }

    public function consulting_room_store(Request $request,$id)
    {
      $request->validate([
        'type'=>'required',
        'state'=>'required',
        'city'=>'required',
        'colony'=>'required',
        'street'=>'required'
        // 'number_ext'=>'required',
      ]);

      if($request->type == 'Otro Especifique:'){
        if($request->otro == Null){
          return back()->withInput($request->all())->with('warning', 'Debes especificar el tipo de Consultiorio');
        }
        $type_consulting_room = $request->otro;
      }else{
        $type_consulting_room = $request->type;
      }

       if($request->city == 'opciones'){
         return back()->with('warning', 'El campo ciudad es requerido')->withInput();
       }

      $consulting_room = new consulting_room;
      $consulting_room->type = $type_consulting_room;
      $consulting_room->state = $request->state;
      $consulting_room->city = $request->city;
      $consulting_room->colony = $request->colony;
      $consulting_room->passwordUnique = $request->password_unique;
      $consulting_room->numberExt = $request->number_ext;
      $consulting_room->numberInt = $request->number_int;
      $consulting_room->name = $request->name_comercial;
      $consulting_room->medico_id = $id;

      $consulting_room->postal_code = $request->postal_code;
      $consulting_room->street = $request->street;
      $consulting_room->save();

        return redirect()->route('medico.edit',$id)->with('success', 'Se a agregado un nuevo consultorio de forma satisfactoria');
    }
    public function consulting_room_edit($id){
      $consulting_room = consulting_room::find($id);
      $medico = medico::find($consulting_room->medico_id);
      $states = state::orderBy('name','asc')->pluck('name','name');
      $cities = city::orderBy('name','asc')->pluck('name','name');
        return view('medico.consulting_room.edit',compact('medico','states','cities','consulting_room'));
    }

    public function consulting_room_create($id)
    {
      $medico = medico::find($id);
      $states = state::orderBy('name','asc')->pluck('name','name');
      $cities = city::orderBy('name','asc')->pluck('name','name');
        return view('medico.consulting_room.create',compact('medico','states','cities'));
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
        'name'=> 'nullable',
        'type'=> 'required',
        'addres'=> 'required',
        'numberExt'=> 'nullable',
        'numberInt'=> 'nullable',
        'colony'=> 'required',
        'city'=> 'required',
        'state'=> 'required',
        'passwordUnique'=> 'nullable',

      ]);

      $consulting_room = new consulting_room;

        if($request->type == 'other'){
          $request->validate([
            'other'=>'required'
          ]);
        }

        $consulting_room->fill($request->all());
        if($request->type == 'other'){
          $consulting_room->type = $request->other;

        }
        $consulting_room->save();

        return redirect()->route('medico.edit',$request->medico_id)->with('success3', 'Nuevo Consultorio agregado de forma satisfactoria');

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
    public function update(Request $request, $id)
    {
        //
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
