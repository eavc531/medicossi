<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\note;
use App\patient;
use App\medico;
use App\element_note;

class notesController extends Controller
{
  public function view_preview($m_id,$p_id,$n_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $note = note::find($n_id);
    $data_note = 0;

    if($note->title == 'Nota Médica Inicial'){
        return view('medico.notes.view_preview.inicial',compact('patient','medico','note','data_note'));
    }elseif($note->title == 'Nota Médica de Evolucion'){
      return view('medico.notes.view_preview.evolucion',compact('patient','medico','note','data_note'));
    }elseif($note->title == 'Nota de Interconsulta'){
      return view('medico.notes.view_preview.interconsulta',compact('patient','medico','note','data_note'));
    }elseif($note->title == 'Nota médica de Urgencias'){
      return view('medico.notes.view_preview.urgencias',compact('patient','medico','note','data_note'));
    }elseif($note->title == 'Nota médica de Egreso'){
      return view('medico.notes.view_preview.egreso',compact('patient','medico','note','data_note'));
    }elseif($note->title == 'Nota de Referencia o traslado'){
      return view('medico.notes.view_preview.referencia',compact('patient','medico','note','data_note'));
    }
  }

  public function note_referencia_create($m_id,$p_id,$n_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $notedefault = note::find($n_id);
    $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();

    if($noteCount == 0){
      $note = $notedefault;
    }else{
      $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
      $note = $noteb;
    }
    return view('medico.notes.referencia.create',compact('patient','medico','note'));
  }
  public function note_referencia_edit($m_id,$p_id,$n_id){
      $patient = patient::find($p_id);
      $medico = medico::find($m_id);
      $note = note::find($n_id);

      return view('medico.notes.referencia.edit',compact('patient','medico','note'));
  }
  public function note_egreso_create($m_id,$p_id,$n_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $notedefault = note::find($n_id);
    $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();

    if($noteCount == 0){
      $note = $notedefault;
    }else{
      $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
      $note = $noteb;
    }
    return view('medico.notes.egreso.create',compact('patient','medico','note'));
  }

  public function note_egreso_edit($m_id,$p_id,$n_id){
      $patient = patient::find($p_id);
      $medico = medico::find($m_id);
      $note = note::find($n_id);

      return view('medico.notes.egreso.edit',compact('patient','medico','note'));
  }

  public function note_urgencias_create($m_id,$p_id,$n_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $notedefault = note::find($n_id);
    $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();

    if($noteCount == 0){
      $note = $notedefault;
    }else{
      $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
      $note = $noteb;
    }
    return view('medico.notes.urgencias.create',compact('patient','medico','note'));
  }

    public function note_urgencias_edit($m_id,$p_id,$n_id){
        $patient = patient::find($p_id);
        $medico = medico::find($m_id);
        $note = note::find($n_id);

        return view('medico.notes.urgencias.edit',compact('patient','medico','note'));
    }

      public function note_inter_create($m_id,$p_id,$n_id){
        $patient = patient::find($p_id);
        $medico = medico::find($m_id);
        $notedefault = note::find($n_id);
        $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();

        if($noteCount == 0){
          $note = $notedefault;
        }else{
          $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
          $note = $noteb;
        }
        return view('medico.notes.inter.create',compact('patient','medico','note'));
      }

      public function note_inter_edit($m_id,$p_id,$n_id){
        $patient = patient::find($p_id);
        $medico = medico::find($m_id);
        $note = note::find($n_id);

        return view('medico.notes.inter.edit',compact('patient','medico','note'));
      }
/////

      public function note_evo_create($m_id,$p_id,$n_id){
        $patient = patient::find($p_id);
        $medico = medico::find($m_id);
        $notedefault = note::find($n_id);
        $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();

        if($noteCount == 0){
          $note = $notedefault;
        }else{
          $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
          $note = $noteb;
        }
        return view('medico.notes.evo.create',compact('patient','medico','note'));
      }


      public function note_evo_edit($m_id,$p_id,$n_id){
        $patient = patient::find($p_id);
        $medico = medico::find($m_id);
        $note = note::find($n_id);

        return view('medico.notes.evo.edit',compact('patient','medico','note'));
      }

    public function note_ini_edit($m_id,$p_id,$n_id){
      $patient = patient::find($p_id);
      $medico = medico::find($m_id);
      $note = note::find($n_id);

      return view('medico.notes.note_ini_edit',compact('patient','medico','note'));
    }

  public function note_config($m_id,$p_id,$n_id){

    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $notedefault = note::find($n_id);
    $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
    if($noteCount == 0){
      $note = $notedefault;
    }else{
      $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
      $note = $noteb;
    }

    if($note->title == 'Nota Médica Inicial'){
        return view('medico.notes.note_medic_ini_config',compact('patient','medico','note'));
    }elseif($note->title == 'Nota Médica de Evolucion'){

      return view('medico.notes.evo.config',compact('patient','medico','note'));
    }elseif($note->title == 'Nota de Interconsulta'){
      return view('medico.notes.inter.config',compact('patient','medico','note'));
    }elseif($note->title == 'Nota médica de Urgencias'){
      return view('medico.notes.urgencias.config',compact('patient','medico','note'));
    }elseif($note->title == 'Nota médica de Egreso'){
      return view('medico.notes.egreso.config',compact('patient','medico','note'));
    }elseif($note->title == 'Nota de Referencia o traslado'){
      return view('medico.notes.referencia.config',compact('patient','medico','note'));
    }

    return view('medico.notes.note_medic_ini_config',compact('patient','medico','note'));
  }


  public function note_config_store(Request $request){

    if($request->title == 'Nota médica de Egreso'){
      $request->validate([
        'fecha_ingreso'=>'required',
        'fecha_egreso'=>'required',
      ]);
    }
    $noteCount = note::where('medico_id',$request->medico_id)->where('title', $request->title)->where('type', 'customized')->count();

    if($noteCount == 0){
      $note = new note;
      $note->title = $request->title;
      $note->medico_id = $request->medico_id;
      $note->Signos_vitales = $request->Signos_vitales;
      $note->Pruebas_de_laboratorio = $request->Pruebas_de_laboratorio;
      $note->type = 'customized';
      $note->save();
    }else{
      $note = note::find($request->note_id);

      $note->Signos_vitales = $request->Signos_vitales;

      $note->Pruebas_de_laboratorio = $request->Pruebas_de_laboratorio;
      $note->save();
    }

      return back()->with('success', 'value');
    }

  public function note_medic_ini_create($m_id,$p_id,$n_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $notedefault = note::find($n_id);
    $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
    if($noteCount == 0){
      $note = $notedefault;
    }else{
      $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
      $note = $noteb;
    }
    return view('medico.notes.note_medic_ini_create',compact('patient','medico','note'));
  }

  public function type_notes($m_id,$p_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);

    $notes_pre = note::where('type', 'default')->get();
    return view('medico.notes.type_notes',compact('patient','medico','notes_pre'));
  }

    public function notes_patient($m_id,$p_id)
    {
       $notes = note::where('patient_id', $p_id)->where('medico_id',$m_id)->orderBy('created_at','desc')->paginate(10);
       $patient = patient::find($p_id);
       $medico = medico::find($m_id);

       return view('medico.notes.notes_patient',compact('notes','patient','medico'));
    }


/////////////////////
    public function medico_note_edit($m_id,$p_id,$n_id){
      $note = note::find($n_id);
      $medico = medico::find($m_id);
      $patient = patient::find($p_id);

      return view('medico.edit_note',compact('note','medico','patient'));
    }


    public function note_update(Request $request,$id){
      // dd($request->all());
      if($request->title == 'Nota médica de Egreso'){
        $request->validate([
          'fecha_ingreso'=>'required',
          'fecha_egreso'=>'required',
        ]);
      }

      $note = note::find($id);
      $note->fill($request->all());
      $note->save();
      return back()->with('success', 'value');
      return redirect()->route('notes_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id]);

    }
    public function note_store(Request $request){
      if($request->title == 'Nota médica de Egreso'){
        $request->validate([
          'fecha_ingreso'=>'required',
          'fecha_egreso'=>'required',
        ]);
      }

      $note = new note;
      $note->fill($request->all());
      $note->save();

      return redirect()->route('notes_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id]);

    }
}
