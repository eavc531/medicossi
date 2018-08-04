<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\specialty_category;
use App\specialty;
use App\sub_specialty;



class specialty_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $categories = specialty_category::orderby('name','asc')->paginate(10);
        return view('specialty.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialty.category.create');
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
        ]);

        $category = new specialty_category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('specialty_category.index')->with('success', 'Se a agregado una nueva categoria');
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
      $category = specialty_category::find($id);
        return view('specialty.category.edit')->with('category', $category);
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
      $category = specialty_category::find($id);
      $cat = $category->name;
      if($request->name != $category->name){
        $request->validate([
          'name'=>'required|unique:specialty_categories',
          'description'=>'nullable',
        ]);
      }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();


        return redirect()->route('specialty_category.index')->with('success','La Categoria: '.$cat. ' ha sido actualizada.' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function specialtyC_delete($id)
     {
         $specialty = specialty::where('specialty_category_id',$id)->count();
         $sub_specialty = sub_specialty::where('specialty_category_id',$id)->count();
         $category = specialty_category::find($id);
         $cat = $category->name;
        if($specialty > 0 or $sub_specialty > 0){
          return back()->with('danger', 'Imposible borrar categoria, existen: '.$specialty.' Especialidades y '.$sub_specialty.' Sub-especialidades Asociada a ella');
        }else{
          $category->delete();
        }

         return back()->with('danger', 'La Categoria: '.$cat.' a sido Eliminada con Exito');

     }
    public function destroy($id)
    {
        //
    }
}
