<?php

namespace App\Http\Controllers;
use App\photo;
use App\patient;

use Illuminate\Http\Request;

class photoController extends Controller
{




    public function patient_image_profile(Request $request)
    {

       $request->validate([
         'image'=>'image|required'
       ]);

       $extension = $request->file('image')->getClientOriginalExtension();

       $photoCount = photo::where('patient_id',$request->patient_id)->where('type','perfil')->count();

       if($photoCount != 0){
         $photo = photo::where('patient_id',$request->patient_id)->where('type','perfil')->first();
        
         if(\File::exists(public_path($photo->path))){
           \File::delete(public_path($photo->path));
           $photo->delete();
         }
       }

        $patient = patient::find($request->patient_id);
         $namePhoto = $patient->name.'.'.$extension;
         $pathSave = 'img/users/'.$patient->identification.'/photos';

         $photo = new photo;
         $photo->name = $patient->name;
         $photo->path = $pathSave.'/'.$namePhoto;

         $photo->type = 'perfil';
         $photo->patient_id = $request->patient_id;

         $photo->save();

         $request->file('image')->move($pathSave,$namePhoto);

         return back()->with('success', 'Nueva imagen de Perfil establecida');
      }



    public function store(Request $request)
    {
        $request->validate([
          'image'=>'image|required'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $photoCount = photo::where('medico_id',$request->medico_id)->count();

        $photoCount = photo::where('medico_id',$request->medico_id)->orderBy('id','desc')->count();
        $photos = photo::where('medico_id',$request->medico_id)->orderBy('id','desc')->first();

        $photos1 = photo::where('medico_id',$request->medico_id)->where('type','perfil')->orderBy('id','desc')->first();
        if($photos1 != Null){
          $photos1->delete();
        }

        if($photoCount == 0){
          $nameP = 1;
        }else{
          $nameP = $photos->id + 1;
        }

        $namePhoto = $nameP.'.'.$extension;
        $pathSave = 'img/users/'.$request->medico_id.'/photos';

        $photo = new photo;
        $photo->name = $nameP;
        $photo->path = $pathSave.'/'.$namePhoto;
        $photo->type = 'perfil';
        $photo->medico_id = $request->medico_id;
        $photo->save();

        $request->file('image')->move($pathSave,$namePhoto);

        return back()->with('success', 'Nueva imagen de Perfil establecida');
    }

    public function image_store(Request $request)
    {

      if(empty($request->file('image'))){
        return back()->with('warning2', 'Debes seleccionar una Imagen');

      }

      $extension = $request->file('image')->getClientOriginalExtension();

        if($extension == 'jpg' or $extension == 'jpeg' or $extension == 'png'){

          $photoCount = photo::where('medico_id',$request->medico_id)->count();
          $photoImageCount = photo::where('medico_id',$request->medico_id)->where('type','image')->count();

          if($photoImageCount >= 8){
            return back()->with('warning2', 'Has excedido el numero de Imagenes que es posible almacenar en tu Cuenta.');
          }
          $photos = photo::where('medico_id',$request->medico_id)->orderBy('id','desc')->first();


          if($photoCount == 0){
            $nameP = 1;
          }else{
            $nameP = $photos->id + 1;
          }

          $namePhoto = $nameP.'.'.$extension;
          $pathSave = 'img/users/'.$request->medico_id.'/photos';

          $photo = new photo;
          $photo->name = $nameP;
          $photo->path = $pathSave.'/'.$namePhoto;
          $photo->medico_id = $request->medico_id;
          $photo->type = 'image';
          $photo->save();

          $request->file('image')->move($pathSave,$namePhoto);

          return back()->with('success2', 'Imagen Guardada Con Exito');
        }else{
          return back()->with('warning2', 'Imposible Subir Imagen, imagen o archivo no compatible');

        }


    }


    public function photo_perfil_medical_store(Request $request)
    {
        $request->validate([
          'image'=>'image|required'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        //$photoCount = photo::where('medicalCenter_id',$request->medicalCenter_id)->count();

        $photoCount = photo::where('medicalCenter_id',$request->medicalCenter_id)->orderBy('id','desc')->count();
        $photos = photo::where('medicalCenter_id',$request->medicalCenter_id)->orderBy('id','desc')->first();

        if($photoCount == 0){
          $nameP = 1;
        }else{
          $nameP = $photos->id + 1;
        }

        $namePhoto = $nameP.'.'.$extension;
        $pathSave = 'img/medicalCenter/'.$request->identification.'/photos';

        $photo = new photo;
        $photo->name = $nameP;
        $photo->path = $pathSave.'/'.$namePhoto;
        $photo->type = 'perfil';
        $photo->medicalCenter_id = $request->medicalCenter_id;
        $photo->save();

        $request->file('image')->move($pathSave,$namePhoto);

        return back()->with('success', 'Nueva imagen de Perfil establecida');
    }

    public function image_store_medical_center(Request $request)
    {

      if(empty($request->file('image'))){
        return back()->with('warning2', 'Debes seleccionar una Imagen');

      }

      $extension = $request->file('image')->getClientOriginalExtension();

        if($extension == 'jpg' or $extension == 'jpeg' or $extension == 'png'){

          $photoCount = photo::where('medicalCenter_id',$request->medicalCenter_id)->count();
          $photoImageCount = photo::where('medicalCenter_id',$request->medicalCenter_id)->where('type','image')->count();

          if($photoImageCount >= 8){
            return back()->with('warning2', 'Has excedido el numero de Imagenes que es posible almacenar en tu Cuenta.');
          }
          $photos = photo::where('medicalCenter_id',$request->medicalCenter_id)->orderBy('id','desc')->first();


          if($photoCount == 0){
            $nameP = 1;
          }else{
            $nameP = $photos->id + 1;
          }

          $namePhoto = $nameP.'.'.$extension;
          $pathSave = 'img/medicalCenter/'.$request->identification.'/photos';

          $photo = new photo;
          $photo->name = $nameP;
          $photo->path = $pathSave.'/'.$namePhoto;

          $photo->medicalCenter_id = $request->medicalCenter_id;
          $photo->type = 'image';
          $photo->save();

          $request->file('image')->move($pathSave,$namePhoto);

          return back()->with('success2', 'Imagen Guardada Con Exito');
        }else{
          return back()->with('warning2', 'Imposible Subir Imagen, imagen o archivo no compatible');

        }


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

     public function photo_delete($id)
     {
       $photo = photo::find($id);
       $photo->delete();

       if(\File::exists(public_path($photo->path))){
         \File::delete(public_path($photo->path));

         return back()->with('danger2','Imagen Eliminada con Exito');
       }else{
         dd('El archivo no existe.');
       }
     }

     public function photo_medical_delete($id)
     {
       $photo = photo::find($id);
       $photo->delete();

       if(\File::exists(public_path($photo->path))){
         \File::delete(public_path($photo->path));

         return back()->with('danger2','Imagen Eliminada con Exito');
       }else{
         return back()->with('danger2','El archivo no existe.');
       }
     }

    public function destroy($id)
    {

    }
}
