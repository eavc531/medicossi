<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medico;
use App\patient;
use App\file;
use App\expedient_file;
use App\expedient;

//validacion personalizada
use Validator;
use App\task_consultation;
use Auth;

use Illuminate\Validation\Rule;

class filesController extends Controller
{

    public function file_download($id){
        $file = file::find($id);

        $pathtoFile = public_path().'/'.$file->path;
        if(file_exists($pathtoFile)){
            return response()->download($pathtoFile);
        }else{
            return back()->with('warning', 'Este archivo no existe o fue eliminado del sistema.');
        }


    }

    public function file_delete_expedient($id){
        $expedient_file = expedient_file::find($id);
        $name = $expedient_file->name;
        $expedient_file->delete();

        return back()->with('danger', 'Se a eliminado el archivo: "'.$name.'" del expediente. Este archivo aun se mantiene en el panel archivos del paciente.');
    }

    public function file_delete($id){
        // $task_consultation = task_consultation::where('file_id',$id)->first();
        // $task_consultation->file_id = Null;
        // $task_consultation->save();

        // verificar si esta enlazado a un expediente
        $expedient_file = expedient_file::where('file_id',$id)->first();

        if($expedient_file != Null){
            $expedient = expedient::find($expedient_file->expedient_id);
            return back()->with('warning', 'Imposible eliminar archivo, este archivo esta enlazado al expediente: "'.$expedient->name.'" por favor eliminelo de dicho expediente para proceder a hacer el borrado completo por este panel.');
        }

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
               if(Auth::user()->role == 'medico'){
                   $file->upload_for = Auth::user()->medico->nameComplete;
               }else{
                   $file->upload_for = Auth::user()->assistant->name.' '.Auth::user()->assistant->lastName;
               }

               $file->save();
        }
            //anotar tarea en la consulta abierta
            if(Auth::user()->role == 'medico'){

                if(Auth::user()->medico->event_id != Null){
                    $task = new task_consultation;
                    $task->task = 'Archivo subido';
                    $task->event_id = Auth::user()->medico->event_id;
                    $task->file_id = $file->id;
                    $task->save();
                }

            }elseif(Auth::user()->role == 'Asistente'){

            }

            if($request->expedient_id != Null){
                $expedient_files = new expedient_file;
                $expedient_files->file_id = $file->id;
                $expedient_files->expedient_id = $request->expedient_id;
                $expedient_files->patient_id = $request->patient_id;
                $expedient_files->medico_id = $request->medico_id;
                $expedient_files->path = $pathSave;
                $expedient_files->name = $nameArchivo;
                $expedient_files->description = $request->description;
                $expedient_files->extension = $extension;
                $expedient_files->size = $size;
                if(Auth::user()->role == 'medico'){
                    $file->upload_for = Auth::user()->medico->nameComplete;
                }else{
                    $file->upload_for = Auth::user()->assistant->name.' '.Auth::user()->assistant->lastName;
                }
                $expedient_files->save();
            }

        return back()->with('success', 'El archivo a sido guardado con exito');

        }


}
