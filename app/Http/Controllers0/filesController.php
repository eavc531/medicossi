<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medico;
use App\patient;
use App\file;
//validacion personalizada
use Validator;
use Illuminate\Validation\Rule;

class filesController extends Controller
{

    public function file_download($id){
        $file = file::find($id);

        $pathtoFile = public_path().'/'.$file->path;
        return response()->download($pathtoFile);

    }
    public function file_delete($id){
        $file = file::find($id);

        if(\File::exists(public_path($file->path))){
          \File::delete(public_path($file->path));

        }

        $file->delete();
        return back()->with('danger','El archivo ha sido eliminado de forma satisfactoria');

    }

    public function patient_files($m_id,$p_id){

        $medico = medico::find($m_id);
        $patient = patient::find($p_id);




        $files = file::where('medico_id',$m_id)->where('patient_id',$p_id)->orderBy('id','desc')->paginate(8);
        return view('medico.patient.files.index',compact('medico','patient','files'));
    }

    public function patient_file_store(Request $request){

        $request->validate([
            'archivo'=>'required|mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf,txt,rtf',
        ]);



        $size = $request->file('archivo')->getClientSize();
        $patient = patient::find($request->patient_id);
        $medico = medico::find($request->medico_id);


        $extension = $request->file('archivo')->extension();
        $pathStore = 'img/users/'.$request->medico_id.'/archivos';

        if($request->name != Null){
        $nameArchivo = $request->name.'.'.$extension;
        $request->file('archivo')->move('public/'.$pathStore,$nameArchivo);

            $verify_name = file::where('medico_id',$request->medico_id)->where('patient_id', $request->patient_id)->where('name',$nameArchivo )->first();

            if($verify_name != Null){
                return back()->with('warning', 'El nombre ya esta siendo usado')->withInput();
            }



            $pathSave = 'img/users/'.$request->medico_id.'/archivos/'.$nameArchivo;

            $file = new file;
               $file->patient_id = $request->patient_id;
               $file->medico_id = $request->medico_id;
               $file->path = $pathSave;
               $file->name = $nameArchivo;
               $file->description = $request->description;
               $file->extension = $extension;
               $file->size = $size;
               $file->save();

        }else{
            $nameArchivo = $request->file('archivo')->getClientOriginalName();
            $verify_name = file::where('medico_id',$request->medico_id)->where('patient_id', $request->patient_id)->where('name',$nameArchivo )->first();

            if($verify_name != Null){
                return back()->with('warning', 'El nombre ya esta siendo usado')->withInput();
            }
            $pathStore = 'img/users/'.$request->medico_id.'/archivos';

            $request->file('archivo')->move('public/'.$pathStore,$nameArchivo);

            $pathSave = 'img/users/'.$request->medico_id.'/archivos/'.$nameArchivo;

            $file = new file;
               $file->patient_id = $request->patient_id;
               $file->medico_id = $request->medico_id;
               $file->path = $pathSave;
               $file->name = $nameArchivo;
               $file->description = $request->description;
               $file->extension = $extension;
               $file->size = $size;
               // $file->upload_for =
               $file->save();
        }

        return back()->with('success', 'El archivo a sido guardado con exito');

        }

}
