<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\note;
use App\patient;
use App\medico;
use App\element_note;
use App\data_patient;
use App\expedient;
use App\expedient_note;
use Session;
use PDF;
//validacion personalizada
use Validator;
//
class notesController extends Controller
{

    public function note_move($id){
        $note = note::find($id);
        $patient = patient::find($note->patient_id);
        // $medico = medico::find($note->medico_id);
        $expedients = expedient::where('medico_id',$note->medico_id)->where('patient_id',$note->patient_id)->paginate(10);

        return view('medico.notes.note_move',compact('expedients','note','patient'));
    }

    public function note_move_store($n_id,$ex_id){
    
        $note = note::find($n_id);
        $expedient = expedient::find($ex_id);
        $verify = expedient_note::where('note_id',$n_id)->where('expedient_id',$ex_id)->first();

        if($verify != Null){
            return back()->with('warning2', 'Ya existe una copia de: '.$note->title.' '.\Carbon\Carbon::parse($note->date_start)->format('d-m-Y').' dentro del expediente: '.$expedient->name)->with('exp',$expedient->name)->with('exp_id', $expedient->id);
        }else{
            $expedient_note = new expedient_note;
            $expedient_note->medico_id = $note->medico_id;
            $expedient_note->patient_id = $note->pateint_id;
            $expedient_note->note_id = $n_id;
            $expedient_note->expedient_id = $ex_id;
            $expedient_note->save();

            return back()->with('success2', 'Se a creado una copia de "'.$note->title.' '.\Carbon\Carbon::parse($note->date_start)->format('d-m-Y').'" en el expediente: '.$expedient->name)->with('exp',$expedient->name)->with('exp_id', $expedient->id);

        }



    }

    public function expedient_search(Request $request){
      $medico = medico::find($request->medico_id);
      $patient = patient::find($request->patient_id);

      // $expedients = expedient::where('medico_id',$request->medico_id)->where('patient_id', $request->pateint_id)->paginate(10);

      if($request->select == 'Nombre'){
        $request->validate([
          'search_name'=>'required|max:255'
        ]);

        $expedients = expedient::where('name','LIKE','%'.$request->search_name.'%')->where('medico_id', $medico->id)->where('patient_id', $patient->id)->paginate(10);


      }else{
        $request->validate([
          'search_date'=>'required'
        ]);

          $expedients = expedient::where('date_start','LIKE','%'.$request->search_date.'%')->where('medico_id', $medico->id)->where('patient_id', $patient->id)->paginate(10);
      }
      $search = 'search';
      return view('medico.expedients_patient.index',compact('expedients','medico','patient','search'));
    }
  public function expedient_update(Request $request,$id){
    $expedient = expedient::find($id);
    $name = $expedient->name;
    $expedient->name = $request->name_exp;
    $expedient->save();

    return back()->with('success', 'Se ha cambiado el nombre del expediente: '.$name.' por el nombre: '.$request->name_exp);
  }
  public function download_expedient_pdf($id){

    $expedient = expedient::find($id);
    $expedient_notes = expedient_note::where('expedient_id',$id)->orderBy('date_start')->get();
    $medico_id = expedient_note::where('expedient_id',$id)->orderBy('date_start')->first()->medico_id;
    $data_patient = data_patient::where('medico_id',$medico_id)->where('patient_id',$expedient->patient_id)->first();

  if($data_patient == Null){
    return redirect()->route('data_patient',['m_id'=>$medico_id,'p_id'=>$expedient->patient_id])->with('warning', 'Antes de poder ver la vista previa de un documento o descargarlo, debe rellenar los datos siguintes.');
  }

    $expedient_id = expedient_note::where('expedient_id',$id)->orderBy('date_start')->first()->patient_id;

    $patient = patient::find($expedient_id);
    $medico = medico::find($medico_id);

    $pdf = PDF::loadView('medico.expedients_patient.expedient_pdf', ['medico'=> $medico,'expedient_notes'=>$expedient_notes,'patient'=>$patient,'expedient'=>$expedient]);
    $date = \Carbon\Carbon::now()->format('d-m-Y');
    return $pdf->download($expedient->name.'_'.$date.'.pdf');

    return view('medico.expedients_patient.expedient_pdf',compact('expedient_notes','expedient','patient','medico'));
  }
  public function expedient_preview($id){
    $expedient = expedient::find($id);
    $expedient_notes = expedient_note::where('expedient_id',$id)->orderBy('date_start')->get();
    $expedient_id = expedient_note::where('expedient_id',$id)->orderBy('date_start')->first()->patient_id;
    $medico_id = expedient_note::where('expedient_id',$id)->orderBy('date_start')->first()->medico_id;
    $patient = patient::find($expedient_id);
    $medico = medico::find($medico_id);
    return view('medico.expedients_patient.preview',compact('expedient_notes','expedient','patient','medico'));
  }

  public function expedient_note_delete($id){

    $expedient = expedient_note::find($id);
    $name = $expedient->note->title.' '.\Carbon\Carbon::parse($expedient->note->date_start)->format('m-d-Y');
    $expedient->delete();

    return back()->with('danger', $name.' ha sido eliminada del Expediente.');
  }

  public function expedient_delete($id){
    $expedient_note = expedient_note::where('expedient_id',$id)->count();
    if($expedient_note > 0){
      return back()->with('warning', 'Imposible Borrar Expediente, contiene "'.$expedient_note.'" nota(s) registrada(s)');
    }

    $expedient = expedient::find($id);
    $name = $expedient->name;
    $expedient->delete();

    return back()->with('danger', 'se ha eliminado el Expediente: '.$name);
  }
  public function expedient_edit(Request $request){

  }
  public function expedient_open($m_id,$p_id,$ex_id){
    $notes_pre = note::where('type', 'default')->get();
    $expedient = expedient::find($ex_id);
    $expedient_notes  = expedient_note::where('expedient_id', $ex_id)->orderBy('note_id','desc')->paginate(10);
    $medico = medico::find($m_id);
    $patient = patient::find($p_id);

    return view('medico.expedients_patient.expedient_open',compact('expedient_notes','medico','patient','notes_pre','expedient'));

  }

  public function expedient_store(Request $request){
//validacion personalizada

      $validator = Validator::make($request->all(), [
        'name'=>'required',
        'date_start'=>'required'
      ]);

      if ($validator->fails()) {
           return back()->with('creando', 'value')
                        ->withErrors($validator)
                        ->withInput();
       }

       $expedient = new expedient;
       $expedient->name = $request->name;
       $expedient->date_start = $request->date_start;
       $expedient->medico_id = $request->medico_id;
       $expedient->patient_id = $request->patient_id;
       $expedient->save();

       return back()->with('success', 'se Agregado un nuevo expediente con el nombre de: '.$request->name);
  }

  public function expedients_patient($m_id,$p_id){
    $medico = medico::find($m_id);
    $patient = patient::find($p_id);
    $expedients = expedient::where('medico_id',$m_id)->where('patient_id', $p_id)->paginate(10);
    $notes_pre = note::where('type', 'default')->get();
    return view('medico.expedients_patient.index',compact('expedients','medico','patient','notes_pre'));
  }

  public function download_pdf($id){

    $note = note::find($id);

    $data_patient = data_patient::where('medico_id',$note->medico_id)->where('patient_id',$note->patient_id)->first();

    if($data_patient == Null){
      return redirect()->route('data_patient',['m_id'=>$note->medico_id,'p_id'=>$note->patient_id])->with('warning', 'Antes de poder ver la vista previa de un documento o descargarlo, debe rellenar los datos siguintes.');
    }
      $medico = medico::find($note->medico_id);
      $patient = patient::find($note->patient_id);
      if($note->title == 'Nota Médica Inicial'){
        $pdf = PDF::loadView('medico.notes.pdf.inicial', ['medico'=> $medico,'note'=>$note,'patient'=>$patient]);
        $date = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y');
        return $pdf->download($note->title.'_'.$date.'.pdf');


      }elseif($note->title == 'Nota Médica de Evolucion'){
        $pdf = PDF::loadView('medico.notes.pdf.evolucion', ['medico'=> $medico,'note'=>$note,'patient'=>$patient]);
        $date = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y');
        return $pdf->download($note->title.'_'.$date.'.pdf');

      }elseif($note->title == 'Nota de Interconsulta'){
        $pdf = PDF::loadView('medico.notes.pdf.interconsulta', ['medico'=> $medico,'note'=>$note,'patient'=>$patient]);
        $date = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y');
        return $pdf->download($note->title.'_'.$date.'.pdf');

      }elseif($note->title == 'Nota médica de Urgencias'){
        $pdf = PDF::loadView('medico.notes.pdf.urgencias', ['medico'=> $medico,'note'=>$note,'patient'=>$patient]);
        $date = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y');
        return $pdf->download($note->title.'_'.$date.'.pdf');

      }elseif($note->title == 'Nota médica de Egreso'){

        $pdf = PDF::loadView('medico.notes.pdf.egreso', ['medico'=> $medico,'note'=>$note,'patient'=>$patient]);
        $date = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y');
        return $pdf->download($note->title.'_'.$date.'.pdf');

      }elseif($note->title == 'Nota de Referencia o traslado'){
        $pdf = PDF::loadView('medico.notes.pdf.referencia', ['medico'=> $medico,'note'=>$note,'patient'=>$patient]);
        $date = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y');
        return $pdf->download($note->title.'_'.$date.'.pdf');
      }

  }

  public function view_preview(Request $request){

    $data_patient = data_patient::where('medico_id',$request->medico_id)->where('patient_id',$request->patient_id)->first();
    if($data_patient == Null){
      return redirect()->route('data_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id])->with('warning', 'Antes de poder ver la vista previa de un documento o descargarlo, debe rellenar los datos siguintes.');
    }
    $patient = patient::find($request->patient_id);
    $medico = medico::find($request->medico_id);
    $note = note::find($request->note_id);
      // dd($note->title);
    $data_note = 0;

    if($request->expedient_id == Null){
      $expedient = Null;
    }else{
      $expedient = expedient::find($request->expedient_id);
    }

    if($note->title == 'Nota Médica Inicial'){
        return view('medico.notes.view_preview.inicial',compact('patient','medico','note','data_note','expedient'));
    }elseif($note->title == 'Nota Médica de Evolucion'){
      return view('medico.notes.view_preview.evolucion',compact('patient','medico','note','data_note','expedient'));
    }elseif($note->title == 'Nota de Interconsulta'){
      return view('medico.notes.view_preview.interconsulta',compact('patient','medico','note','data_note','expedient'));
    }elseif($note->title == 'Nota médica de Urgencias'){
      return view('medico.notes.view_preview.urgencias',compact('patient','medico','note','data_note','expedient'));
    }elseif($note->title == 'Nota médica de Egreso'){
      return view('medico.notes.view_preview.egreso',compact('patient','medico','note','data_note','expedient'));
    }elseif($note->title == 'Nota de Referencia o traslado'){
      return view('medico.notes.view_preview.referencia',compact('patient','medico','note','data_note','expedient'));
    }
  }

  public function note_referencia_edit(Request $request){
      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      $note = note::find($request->note_id);

      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }
      return view('medico.notes.referencia.edit',compact('patient','medico','note','expedient'));
  }

  public function note_egreso_edit(Request $request,$m_id,$p_id,$n_id){
    $patient = patient::find($p_id);
    $medico = medico::find($m_id);
    $note = note::find($n_id);

    if($request->expedient_id == Null){
      $expedient = Null;
    }else{
      $expedient = expedient::find($request->expedient_id);
    }

      return view('medico.notes.egreso.edit',compact('patient','medico','note','expedient'));
  }

    public function note_urgencias_edit(Request $request){
      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      $note = note::find($request->note_id);

      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }

        return view('medico.notes.urgencias.edit',compact('patient','medico','note','expedient'));
    }

      public function note_inter_edit(Request $request){
        $patient = patient::find($request->patient_id);
        $medico = medico::find($request->medico_id);
        $note = note::find($request->note_id);

        if($request->expedient_id == Null){
          $expedient = Null;
        }else{

          $expedient = expedient::find($request->expedient_id);
        }

        return view('medico.notes.inter.edit',compact('patient','medico','note','expedient'));
      }
/////
      public function note_evo_edit(Request $request){
        $patient = patient::find($request->patient_id);
        $medico = medico::find($request->medico_id);
        $note = note::find($request->note_id);

        if($request->expedient_id == Null){
          $expedient = Null;
        }else{
          $expedient = expedient::find($request->expedient_id);
        }

        return view('medico.notes.evo.edit',compact('patient','medico','note','expedient'));
      }

    public function note_ini_edit(Request $request){

      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      $note = note::find($request->note_id);

      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }
      return view('medico.notes.note_ini_edit',compact('patient','medico','note','expedient'));
    }

  public function note_config(Request $request){

    $patient = patient::find($request->patient_id);
    $medico = medico::find($request->medico_id);
    // dd($request->medico_id);
    $notedefault = note::find($request->note_id);
    $noteCount = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->count();


    if($noteCount == 0){
      $note = new note;
      $note->title = $notedefault->title;
      $note->medico_id = $request->medico_id;
      $note->Signos_vitales = $notedefault->Signos_vitales;
      $note->Pruebas_de_laboratorio = $notedefault->Pruebas_de_laboratorio;
      $note->type = 'customized';
      $note->Signos_vitales_show = 'si';
      $note->Motivo_de_atencion_show = 'si';
      $note->Exploracion_fisica_show = 'si';
      $note->Pruebas_de_laboratorio_show = 'si';
      $note->Diagnostico_show = 'si';
      $note->Afeccion_principal_o_motivo_de_consulta_show = 'si';
      $note->Afeccion_secundaria_show = 'si';
      $note->Pronostico_show = 'si';
      $note->Tratamiento_y_o_recetas_show = 'si';
      $note->Indicaciones_terapeuticas_show = 'si';
      $note->Estado_mental_show = 'si';
      $note->Resultados_relevantes_show = 'si';
      $note->Manejo_durante_la_estancia_hospitalaria_show = 'si';
      $note->Recomendaciones_para_vigilancia_ambulatoira_show = 'si';
      $note->Otros_datos_show = 'si';
      $note->Motivo_de_envio_show = 'si';
      $note->Evolucion_y_actualizacion_del_cuadro_clinico_show = 'si';
      $note->Motivo_del_egreso_show = 'si';
      $note->Diagnosticos_finales_show = 'si';
      $note->Resumen_de_evolucion_y_estado_actual_show = 'si';
      $note->Problemas_clinicos_pendientes_show = 'si';
      $note->Plan_de_manejo_y_tratamiento_show = 'si';
      $note->Establecimiento_que_envia_show = 'si';
      $note->Sugerencias_y_tratamiento_show = 'si';
      $note->save();
    }else{
        // dd('sd');
      $note = note::where('medico_id',$request->medico_id)->where('title', $notedefault->title)->where('type', 'customized')->first();
      // $note->Signos_vitales = $notedefault->Signos_vitales;
      // $note->Pruebas_de_laboratorio = $notedefault->Pruebas_de_laboratorio;
      // $note->save();
    }

    if($request->expedient_id == Null){
      $expedient = Null;
    }else{
      $expedient = expedient::find($request->expedient_id);
    }

    if($note->title == 'Nota Médica Inicial'){
        return view('medico.notes.note_medic_ini_config',compact('patient','medico','note','expedient'));
    }elseif($note->title == 'Nota Médica de Evolucion'){

      return view('medico.notes.evo.config',compact('patient','medico','note','expedient'));
    }elseif($note->title == 'Nota de Interconsulta'){
      return view('medico.notes.inter.config',compact('patient','medico','note','expedient'));
    }elseif($note->title == 'Nota médica de Urgencias'){
      return view('medico.notes.urgencias.config',compact('patient','medico','note','expedient'));
    }elseif($note->title == 'Nota médica de Egreso'){
      return view('medico.notes.egreso.config',compact('patient','medico','note','expedient'));
    }elseif($note->title == 'Nota de Referencia o traslado'){
      return view('medico.notes.referencia.config',compact('patient','medico','note','expedient'));
    }

    return view('medico.notes.note_medic_ini_config',compact('patient','medico','note','expedient'));
  }

  public function note_config_store(Request $request){

    $noteCount = note::where('medico_id',$request->medico_id)->where('title', $request->title)->where('type', 'customized')->count();

      $note = note::where('medico_id',$request->medico_id)->where('title', $request->title)->where('type', 'customized')->first();
      $note->Signos_vitales = $request->Signos_vitales;
      $note->Pruebas_de_laboratorio = $request->Pruebas_de_laboratorio;
      $note->save();

    // dd($request->all());
    if($request->boton_submit == 'Guardar'){
      return redirect()->route('expedient_open',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id,'ex_id'=>$request->expedient_id])->with('success', 'Nueva Configuracion guardada para: '.$note->title);

    }else{
        return redirect()->route('notes_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id])->with('success', 'Nueva Configuracion guardada para: '.$note->title);
    }
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
        $notes_pre = note::where('type', 'default')->get();
       $medico = medico::find($m_id);

       return view('medico.notes.notes_patient',compact('notes','patient','medico','notes_pre'));
    }



    public function note_search(Request $request)
    {
      $notes_pre = note::where('type', 'default')->get();
      if($request->select == 'Tipo de Nota'){
        $request->validate([
          'type'=>'required'
        ]);

        if($request->type == 'Todas'){
          return redirect()->route('notes_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id]);
        }
        $notes = note::where('patient_id', $request->patient_id)->where('medico_id',$request->medico_id)->where('title',$request->type)->orderBy('created_at','desc')->paginate(10);

        $patient = patient::find($request->patient_id);
        $medico = medico::find($request->medico_id);
        $search = 'search_note';
        return view('medico.notes.notes_patient',compact('notes','patient','medico','search','notes_pre'));
      }else{
        $request->validate([
          'type'=>'required',
          'date'=>'required'
        ]);

        if($request->type == 'Todas'){
            $notes = note::where('patient_id',$request->patient_id)->where('medico_id',$request->medico_id)->where('created_at','LIKE',"%$request->date%")->orderBy('created_at','desc')->paginate(10);
            $patient = patient::find($request->patient_id);
            $medico = medico::find($request->medico_id);
            $search = 'search_note';

            return view('medico.notes.notes_patient',compact('notes','patient','medico','search','notes_pre'));
        }

        $notes = note::where('patient_id',$request->patient_id)->where('medico_id',$request->medico_id)->where('title', $request->type)->where('created_at','LIKE',"%$request->date%")->orderBy('created_at','desc')->paginate(10);
        $patient = patient::find($request->patient_id);
        $medico = medico::find($request->medico_id);
        $search = 'search_note';

        return view('medico.notes.notes_patient',compact('notes','patient','medico','search','notes_pre'));
      }

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

      $request->validate([
        'exploracion_fisica'=>'max:255',
      ]);

      $note = note::find($id);
      $note->fill($request->all());
      $note->date_edit = \Carbon\Carbon::now();
      $note->save();

      if($request->boton_submit == 'Guardar'){
        return redirect()->route('expedient_open',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id,'ex_id'=>$request->expedient_id])->with('success', 'se han guardado los datos de forma satisfactoria');;

      }else{
          return redirect()->route('notes_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id])->with('success', 'se han guardado los datos de forma satisfactoria');
      }

    }
    public function note_store(Request $request){

      if($request->title == 'Nota médica de Egreso'){
        $request->validate([
          'fecha_egreso'=>'required',
          'fecha_ingreso'=>'required',
        ]);
      }

      $request->validate([

        'Exploracion_fisica'=>'max:255',
        'Diagnostico'=>'max:255',
        'Afeccion_principal_o_motivo_de_consulta'=>'max:255',
        'Afeccion_secundaria'=>'max:255',
        'Pronostico'=>'max:255',
        'Tratamiento_y_o_receta'=>'max:255',
        'Indicaciones_terapeuticas'=>'max:255',
        'Evolucion_y_actualizacion_del_cuadro_clinico'=>'max:255',
        'Sugerencias_y_tratamiento'=>'max:255',

        'Motivo_de_atencion'=>'max:255',
        'Estado_mental'=>'max:255',
        'Resultados_relevantes_de_los_servicios_auxiliares_de_diagnostico'=>'max:255',
        'Manejo_durante_la_estancia_hospitalaria'=>'max:255',
        'Recomendaciones_para_vigilancia_ambulatoira'=>'max:255',
        'Otros_datos'=>'max:255',
        'Motivo_de_envio'=>'max:255',
        'Motivo_del_egreso'=>'max:255',
        'Diagnosticos_finales'=>'max:255',
        'Resumen_de_evolucion_y_estado_actual'=>'max:255',
        'Problemas_clinicos_pendientes'=>'max:255',
        'Plan_de_manejo_y_tratamiento'=>'max:255',
        'Establecimiento_que_envia'=>'max:255',
        'Establecimiento_receptor'=>'max:255',

      ]);
      $note_config = note::find($request->note_config_id);

      $note = new note;


      $note->fill($request->all());
      $note->Signos_vitales_show = $note_config->Signos_vitales_show;
      $note->Motivo_de_atencion_show = $note_config->Motivo_de_atencion_show;
      $note->Exploracion_fisica_show = $note_config->Exploracion_fisica_show;
      $note->Pruebas_de_laboratorio_show = $note_config->Pruebas_de_laboratorio_show;
      $note->Diagnostico_show = $note_config->Diagnostico_show;
      $note->Afeccion_principal_o_motivo_de_consulta_show = $note_config->Afeccion_principal_o_motivo_de_consulta_show;
      $note->Afeccion_secundaria_show = $note_config->Afeccion_secundaria_show;
      $note->Pronostico_show = $note_config->Pronostico_show;
      $note->Tratamiento_y_o_recetas_show = $note_config->Tratamiento_y_o_recetas_show;
      $note->Indicaciones_terapeuticas_show = $note_config->Indicaciones_terapeuticas_show;
      $note->Estado_mental_show = $note_config->Estado_mental_show;
      $note->Resultados_relevantes_show = $note_config->Resultados_relevantes_show;
      $note->Manejo_durante_la_estancia_hospitalaria_show = $note_config->Manejo_durante_la_estancia_hospitalaria_show;
      $note->Recomendaciones_para_vigilancia_ambulatoira_show = $note_config->Recomendaciones_para_vigilancia_ambulatoira_show;
      $note->Otros_datos_show = $note_config->Otros_datos_show;
      $note->Motivo_de_envio_show = $note_config->Motivo_de_envio_show;
      $note->Evolucion_y_actualizacion_del_cuadro_clinico_show = $note_config->Evolucion_y_actualizacion_del_cuadro_clinico_show;
      $note->Motivo_del_egreso_show = $note_config->Motivo_del_egreso_show;
      $note->Diagnosticos_finales_show = $note_config->Diagnosticos_finales_show;
      $note->Resumen_de_evolucion_y_estado_actual_show = $note_config->Resumen_de_evolucion_y_estado_actual_show;
      $note->Problemas_clinicos_pendientes_show = $note_config->Problemas_clinicos_pendientes_show;
      $note->Plan_de_manejo_y_tratamiento_show = $note_config->Plan_de_manejo_y_tratamiento_show;
      $note->Establecimiento_que_envia_show = $note_config->Establecimiento_que_envia_show;
      $note->Establecimiento_receptor_show = $note_config->Establecimiento_receptor_show;
      $note->Sugerencias_y_tratamiento_show = $note_config->Sugerencias_y_tratamiento_show;



      $note->date_start = $request->date_start;
      $note->save();
      if($request->boton_submit == 'Guardar Nota en Expediente'){
        $expedient_verify = expedient_note::where('expedient_id', $request->expedient_id)->first();
          $expedient_note = new expedient_note;
          $expedient_note->name = 'x';
          $expedient_note->medico_id = $request->medico_id;
          $expedient_note->patient_id = $request->patient_id;
          $expedient_note->expedient_id = $request->expedient_id;
          $expedient_note->note_id = $note->id;
          $expedient_note->save();
      }


      if($request->boton_submit == 'Guardar Nota en Expediente'){
        return redirect()->route('expedient_open',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id,'ex_id'=>$request->expedient_id]);

      }else{
          return redirect()->route('notes_patient',['m_id'=>$request->medico_id,'p_id'=>$request->patient_id])->with('success', 'Nueva nota Médica creada');
      }
    }

    public function check_input_notes(Request $request){
      // return response()->json($request->all());
      $note = note::find($request->note_id);

      if($request->variable == 'Signos_vitales_show'){
        if($note->Signos_vitales_show == 'si'){
          $note->Signos_vitales_show  = 'no';
          $result = 'no';
        }else{
          $note->Signos_vitales_show  = 'si';
          $result = 'si';
        }
      }elseif($request->variable == 'Motivo_de_atencion_show'){
        if($note->Motivo_de_atencion_show == 'si'){
          $note->Motivo_de_atencion_show  = 'no';
          $result = 'no';
        }else{
          $note->Motivo_de_atencion_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Exploracion_fisica_show'){
        if($note->Exploracion_fisica_show == 'si'){
          $note->Exploracion_fisica_show  = 'no';
          $result = 'no';
        }else{
          $note->Exploracion_fisica_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Pruebas_de_laboratorio_show'){
        if($note->Pruebas_de_laboratorio_show == 'si'){
          $note->Pruebas_de_laboratorio_show  = 'no';
          $result = 'no';
        }else{
          $note->Pruebas_de_laboratorio_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Diagnostico_show'){
        if($note->Diagnostico_show == 'si'){
          $note->Diagnostico_show  = 'no';
          $result = 'no';
        }else{
          $note->Diagnostico_show  = 'si';
          $result = 'si';
        }


      }elseif($request->variable == 'Afeccion_principal_o_motivo_de_consulta_show'){
        if($note->Afeccion_principal_o_motivo_de_consulta_show == 'si'){
          $note->Afeccion_principal_o_motivo_de_consulta_show  = 'no';
          $result = 'no';
        }else{
          $note->Afeccion_principal_o_motivo_de_consulta_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Afeccion_secundaria_show'){
        if($note->Afeccion_secundaria_show == 'si'){
          $note->Afeccion_secundaria_show  = 'no';
          $result = 'no';
        }else{
          $note->Afeccion_secundaria_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Pronostico_show'){

        if($note->Pronostico_show == 'si'){
          $note->Pronostico_show  = 'no';
          $result = 'no';
        }else{
          $note->Pronostico_show  = 'si';
          $result = 'si';
        }
      }elseif($request->variable == 'Tratamiento_y_o_recetas_show'){

        if($note->Tratamiento_y_o_recetas_show == 'si'){
          $note->Tratamiento_y_o_recetas_show  = 'no';
          $result = 'no';
        }else{
          $note->Tratamiento_y_o_recetas_show  = 'si';
          $result = 'si';
        }
      }elseif($request->variable == 'Indicaciones_terapeuticas_show'){
        if($note->Indicaciones_terapeuticas_show == 'si'){
          $note->Indicaciones_terapeuticas_show  = 'no';
          $result = 'no';
        }else{
          $note->Indicaciones_terapeuticas_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Estado_mental_show'){

        if($note->Estado_mental_show == 'si'){
          $note->Estado_mental_show  = 'no';
          $result = 'no';
        }else{
          $note->Estado_mental_show  = 'si';
          $result = 'si';
        }
      }elseif($request->variable == 'Resultados_relevantes_show'){

        if($note->Resultados_relevantes_show == 'si'){
          $note->Resultados_relevantes_show  = 'no';
          $result = 'no';
        }else{
          $note->Resultados_relevantes_show  = 'si';
          $result = 'si';
        }
      }elseif($request->variable == 'Manejo_durante_la_estancia_hospitalaria_show'){

        if($note->Manejo_durante_la_estancia_hospitalaria_show == 'si'){
          $note->Manejo_durante_la_estancia_hospitalaria_show  = 'no';
          $result = 'no';
        }else{
          $note->Manejo_durante_la_estancia_hospitalaria_show  = 'si';
          $result = 'si';
        }
      }elseif($request->variable == 'Recomendaciones_para_vigilancia_ambulatoira_show'){
        if($note->Recomendaciones_para_vigilancia_ambulatoira_show == 'si'){
          $note->Recomendaciones_para_vigilancia_ambulatoira_show  = 'no';
          $result = 'no';
        }else{
          $note->Recomendaciones_para_vigilancia_ambulatoira_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Otros_datos_show'){
        if($note->Otros_datos_show == 'si'){
          $note->Otros_datos_show  = 'no';
          $result = 'no';
        }else{
          $note->Otros_datos_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Motivo_de_envio_show'){
        if($note->Motivo_de_envio_show == 'si'){
          $note->Motivo_de_envio_show  = 'no';
          $result = 'no';
        }else{
          $note->Motivo_de_envio_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Evolucion_y_actualizacion_del_cuadro_clinico_show'){
        if($note->Evolucion_y_actualizacion_del_cuadro_clinico_show == 'si'){
          $note->Evolucion_y_actualizacion_del_cuadro_clinico_show  = 'no';
          $result = 'no';
        }else{
          $note->Evolucion_y_actualizacion_del_cuadro_clinico_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Motivo_del_egreso_show'){
        if($note->Motivo_del_egreso_show == 'si'){
          $note->Motivo_del_egreso_show  = 'no';
          $result = 'no';
        }else{
          $note->Motivo_del_egreso_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Diagnosticos_finales_show'){
        if($note->Diagnosticos_finales_show == 'si'){
          $note->Diagnosticos_finales_show  = 'no';
          $result = 'no';
        }else{
          $note->Diagnosticos_finales_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Resumen_de_evolucion_y_estado_actual_show'){
        if($note->Resumen_de_evolucion_y_estado_actual_show == 'si'){
          $note->Resumen_de_evolucion_y_estado_actual_show  = 'no';
          $result = 'no';
        }else{
          $note->Resumen_de_evolucion_y_estado_actual_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Problemas_clinicos_pendientes_show'){
        if($note->Problemas_clinicos_pendientes_show == 'si'){
          $note->Problemas_clinicos_pendientes_show  = 'no';
          $result = 'no';
        }else{
          $note->Problemas_clinicos_pendientes_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Plan_de_manejo_y_tratamiento_show'){
        if($note->Plan_de_manejo_y_tratamiento_show == 'si'){
          $note->Plan_de_manejo_y_tratamiento_show  = 'no';
          $result = 'no';
        }else{
          $note->Plan_de_manejo_y_tratamiento_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Establecimiento_que_envia_show'){
        if($note->Establecimiento_que_envia_show == 'si'){
          $note->Establecimiento_que_envia_show  = 'no';
          $result = 'no';
        }else{
          $note->Establecimiento_que_envia_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Establecimiento_receptor_show'){
        if($note->Establecimiento_receptor_show == 'si'){
          $note->Establecimiento_receptor_show  = 'no';
          $result = 'no';
        }else{
          $note->Establecimiento_receptor_show  = 'si';
          $result = 'si';
        }

      }elseif($request->variable == 'Sugerencias_y_tratamiento_show'){

        if($note->Sugerencias_y_tratamiento_show == 'si'){
          $note->Sugerencias_y_tratamiento_show  = 'no';
          $result = 'no';
        }else{
          $note->Sugerencias_y_tratamiento_show  = 'si';
          $result = 'si';
        }
      }

      $note->save();

      $response = ['result'=>$result,'variable'=>$request->variable];

      return response()->json($response);
    }

    public function note_medic_ini_create(Request $request){

      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      // dd($request->medico_id);
      $notedefault = note::find($request->note_id);
      $noteCount = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
      if($noteCount == 0){
        $note = $notedefault;
      }else{
        $noteb = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
        $note = $noteb;
      }
      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }
      return view('medico.notes.note_medic_ini_create',compact('patient','medico','note','expedient'));
    }

    public function note_referencia_create(Request $request){

      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      // dd($request->medico_id);
      $notedefault = note::find($request->note_id);
      $noteCount = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
      if($noteCount == 0){
        $note = $notedefault;
      }else{
        $noteb = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
        $note = $noteb;
      }
      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }

      return view('medico.notes.referencia.create',compact('patient','medico','note','expedient'));
    }
    public function note_egreso_create(Request $request,$m_id,$p_id,$n_id){
      $patient = patient::find($p_id);
      $medico = medico::find($m_id);
      // dd($request->medico_id);
      $notedefault = note::find($n_id);
      $noteCount = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
      if($noteCount == 0){
        $note = $notedefault;
      }else{
        $noteb = note::where('medico_id',$m_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
        $note = $noteb;
      }
      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }
      return view('medico.notes.egreso.create',compact('patient','medico','note','expedient'));
    }
    public function note_urgencias_create(Request $request){
      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      // dd($request->medico_id);
      $notedefault = note::find($request->note_id);
      $noteCount = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
      if($noteCount == 0){
        $note = $notedefault;
      }else{
        $noteb = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
        $note = $noteb;
      }
      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }

      return view('medico.notes.urgencias.create',compact('patient','medico','note','expedient'));
    }
      public function note_inter_create(Request $request){
        $patient = patient::find($request->patient_id);
        $medico = medico::find($request->medico_id);
        // dd($request->medico_id);
        $notedefault = note::find($request->note_id);
        $noteCount = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
        if($noteCount == 0){
          $note = $notedefault;
        }else{
          $noteb = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
          $note = $noteb;
        }
        if($request->expedient_id == Null){
          $expedient = Null;
        }else{
          $expedient = expedient::find($request->expedient_id);
        }
        return view('medico.notes.inter.create',compact('patient','medico','note','expedient'));
      }
    public function note_evo_create(Request $request){
      $patient = patient::find($request->patient_id);
      $medico = medico::find($request->medico_id);
      // dd($request->medico_id);
      $notedefault = note::find($request->note_id);
      $noteCount = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->count();
      if($noteCount == 0){
        $note = $notedefault;
      }else{
        $noteb = note::where('medico_id',$request->medico_id)->where('title',$notedefault->title)->where('type', 'customized')->first();
        $note = $noteb;
      }
      if($request->expedient_id == Null){
        $expedient = Null;
      }else{
        $expedient = expedient::find($request->expedient_id);
      }

      return view('medico.notes.evo.create',compact('patient','medico','note','expedient'));
    }

}
