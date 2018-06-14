<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\consulting_room;
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


    public function consulting_room_create($id)
    {
        return view('medico.consulting_room.create')->with('medico_id',$id);
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
