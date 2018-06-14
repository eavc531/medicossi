<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sub_specialty;
use App\specialty_category;

class sub_specialtyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $specialties = sub_specialty::orderBy('id','desc')->paginate(10);

    return view('specialty.sub_specialty.index')->with('specialties', $specialties);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = specialty_category::orderBy('name','asc')->pluck('name','id');

    return view('specialty.sub_specialty.create')->with('categories', $categories);
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
      'name'=>'required|unique:specialty_categories',
      'description'=>'nullable',
      'specialty_category_id'=>'required',
    ]);
      $specialty = new sub_specialty;
      $specialty->fill($request->all());
      $specialty->save();

      return redirect()->route('sub_specialty.index')->with('success', 'Categoria creada de forma Satisfactoria');

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
      $categories = specialty_category::orderBy('name','asc')->pluck('name','id');
      $category = sub_specialty::find($id);
      return view('specialty.sub_specialty.edit')->with('category', $category)->with('categories', $categories);
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
    $specialty = sub_specialty::find($id);

    if($request->name != $specialty->name){
      $request->validate([
        'name'=>'required|unique:specialty_categories',
        'description'=>'nullable',
      ]);
    }

      $specialty->fill($request->all());

      $specialty->save();


      return redirect()->route('sub_specialty.index')->with('success','La Categoria: '.$request->name. ' ha sido actualizada.' );


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
