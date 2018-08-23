<?php

public function store_rate_comentary(Request $request)
{
  //dd($request->all());
 $medico = medico::find($request->medico_id);

  if($request->conservar == 'conservar'){

      $event = event::find($request->event_id);
      $event->status = 'calificada';
      $event->save();

     return redirect()->route('patient_appointments',\Hashids::encode($request->patient_id))->with('success', 'Se a guardado tu opinion referente al Médico : '.$medico->name.' '.$medico->lastName.'.');
  }

  if($request->rate == 6){
    return back()->with('warning', 'El campo Calificación es requerido');
  }
  $request->validate([
    'rate'=>'required',
    'comentary'=>'max:200'
  ]);


  $calification = '';
  switch ($request->rate) {
case  Null:
   $calification = 'Neutral';
   break;
case 1:
   $calification = 'Pesimo';
   break;
case 2:
   $calification = 'Malo';
   break;
case 3:
   $calification = 'Regular';
   break;
case 4:
   $calification = 'Buena';
   break;
case 5:
   $calification = 'Excelente';
   break;

 }

 $rate_medic1 = rate_medic::where('patient_id',$request->patient_id)->where('medico_id',$request->medico_id)->count();
 $rate_medic2 = rate_medic::where('patient_id',$request->patient_id)->where('medico_id',$request->medico_id)->first();
 if($rate_medic1 != 0){

   $rate_medic2->delete();
 }

 $rate_medic = new rate_medic;
 $rate_medic->rate = $request->rate;
 $rate_medic->comentary = $request->comentary;
 $rate_medic->patient_id = $request->patient_id;
 $rate_medic->medico_id = $request->medico_id;
 if($medico->show_comentary == 'Si'){
   $rate_medic->show = 'Si';
 }else{
   $rate_medic->show = 'No';
 }
 $rate_medic->save();

 $rate_medicT = rate_medic::where('medico_id',$request->medico_id)->get();
 $count = rate_medic::where('medico_id',$request->medico_id)->count();

 $suma = 0;
  foreach ($rate_medicT as $value) {
    $suma = $suma + $value->rate;
  }


   $medico->calification = $suma / $count;
   $medico->votes = $count;
   $medico->save();

   $event = event::find($request->event_id);
   $event->status = 'calificada';
   $event->save();

  return redirect()->route('patient_appointments',\Hashids::encode($request->patient_id))->with('success', 'Se aguardado tu opinion referente al Médico : '.$medico->name.' '.$medico->lastName.'.');
}


///////////////////////









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

/////////////////////////////
$vital_sign_config = vital_sign::find($request->vital_sign_config_id);

if($request->Altura_show == Null){
    $vital_sign_config->Altura_show = Null;
}else{
    $vital_sign_config->Altura_show = 'si';
}
if($request->Peso_show == Null){
    $vital_sign_config->Peso_show = Null;
}else{
    $vital_sign_config->Peso_show = 'si';
}
if($request->Tensión_Arterial_show == Null){
    $vital_sign_config->Tensión_Arterial_show = Null;
}else{
    $vital_sign_config->Tensión_Arterial_show = 'si';
}
if($request->Temperatura_Corporal_show == Null){
    $vital_sign_config->Temperatura_Corporal_show = Null;
}else{
    $vital_sign_config->Temperatura_Corporal_show = 'si';
}
if($request->Frecuencia_Cardíaca_show == Null){
    $vital_sign_config->Frecuencia_Cardíaca_show = Null;
}else{
    $vital_sign_config->Frecuencia_Cardíaca_show = 'si';
}
if($request->Frecuencia_Respiratoria_show == Null){
    $vital_sign_config->Frecuencia_Respiratoria_show = Null;
}else{
    $vital_sign_config->Frecuencia_Respiratoria_show = 'si';
}
if($request->Oxigenación_show == Null){
    $vital_sign_config->Oxigenación_show = Null;
}else{
    $vital_sign_config->Oxigenación_show = 'si';
}
if($request->Índice_de_Masa_Corporal_show == Null){
    $vital_sign_config->Índice_de_Masa_Corporal_show = Null;
}else{
    $vital_sign_config->Índice_de_Masa_Corporal_show = 'si';
}
if($request->Porcentaje_de_Grasa_Corporal_show == Null){
    $vital_sign_config->Porcentaje_de_Grasa_Corporal_show = Null;
}else{
    $vital_sign_config->Porcentaje_de_Grasa_Corporal_show = 'si';
}
if($request->Índice_de_Masa_Muscular_show == Null){
    $vital_sign_config->Índice_de_Masa_Muscular_show = Null;
}else{
    $vital_sign_config->Índice_de_Masa_Muscular_show = 'si';
}
if($request->Cintura_show == Null){
    $vital_sign_config->Cintura_show = Null;
}else{
    $vital_sign_config->Cintura_show = 'si';
}
if($request->Cadera_show == Null){
    $vital_sign_config->Cadera_show = Null;
}else{
    $vital_sign_config->Cadera_show = 'si';
}
if($request->Perímetro_Cefálico_show == Null){
    $vital_sign_config->Perímetro_Cefálico_show = Null;
}else{
    $vital_sign_config->Perímetro_Cefálico_show = 'si';
}



    $vital_sign_config->save();
    return response()->json($request->all());

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Altura')->nullable();
            $table->string('Altura show')->nullable();
            $table->string('Peso')->nullable();
            $table->string('Peso show')->nullable();
            $table->string('Tensión Arterial')->nullable();
            $table->string('Tensión Arterial show')->nullable();
            $table->string('Temperatura Corporal')->nullable();
            $table->string('Temperatura Corporal show')->nullable();
            $table->string('Frecuencia Cardíaca')->nullable();
            $table->string('Frecuencia Cardíaca show')->nullable();
            $table->string('Frecuencia Respiratoria')->nullable();
            $table->string('Frecuencia Respiratoria show')->nullable();
            $table->string('Oxigenación')->nullable();
            $table->string('Oxigenación show')->nullable();
            $table->string('Índice de Masa Corporal')->nullable();
            $table->string('Índice de Masa Corporal show')->nullable();
            $table->string('Porcentaje de Grasa Corporal')->nullable();
            $table->string('Porcentaje de Grasa Corporal show')->nullable();
            $table->string('Índice de Masa Muscular')->nullable();
            $table->string('Índice de Masa Muscular show')->nullable();
            $table->string('Cintura')->nullable();
            $table->string('Cintura show')->nullable();
            $table->string('Cadera')->nullable();
            $table->string('Cadera show')->nullable();
            $table->string('Perímetro Cefálico')->nullable();
            $table->string('Perímetro Cefálico show')->nullable();
            $table->integer('note_id')->unsigned()->nullable();
            $table->foreign('note_id')->references('id')->on('notes');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vital_signs');
    }
}

//signos vitales



@elseif(Auth::check() and Auth::user()->hasRole('medico') and Auth::user()->medico->plan == Null)

    <!-- Copia desde aqui abajo -->
    <div class="box-dashboard" id="dashboard">
      <div class="row">

        <div class="col-12">
          <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
        </div>

      </div>
      <div class="row">

        <div class="col-12">
          <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-home fa-2"></i><span>Inicio</a>
          </div>
        <div class="col-12">
          <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
        </div>
        <div class="col-12">
          <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-gift"></i><span>Compartir</span></a>
        </div>
      </div>
      <div class="row py-1">
        <div class="col-12">

            <a href="{{route('medico_diary', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span style="font-size:10px;background:rgb(222, 46, 8);border-radius:10px;padding:5px;border-color:white;">Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>

        </div>
        <div class="col-12">
          <a href="{{route('medico.edit', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
        </div>
        {{-- <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Panel de control</span></a>
        </div> --}}

          <div class="col-12">

          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-list-alt"></i><span>Calificación</span></a>
        </div>

      </div>

      <div class="row">

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-book"></i><span>Mi Agenda</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('planes_medic',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Planes</span></a>
        </div>

        <div class="col-12">
          <a href="{{route('medico_diary',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Ingresos</span></a>
        </div>

        {{-- <div class="col-12">
          <a href="{{route('reminders_medico',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
        </div> --}}
        <div class="col-12">
          <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
        </div>

      </div>
    </div>
    <!-- Hasta aqui -->
  @elseif(Auth::check() and Auth::user()->hasRole('medico'))
  <!-- Copia desde aqui abajo -->
  <div class="box-dashboard" id="dashboard">
    <div class="row">

      <div class="col-12">
        <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
      </div>

    </div>
    <div class="row">
      @if(Auth::user()->medico->plan != Null)
        <div class="col-12">
          <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic" style="border-bottom:solid 1px white"><strong><span style="font-size:14px;color:white;" class="p-2 m-1"> @if(Auth::user()->medico->plan == 'plan_profesional') Plan: Plan Profesional @elseif(Auth::user()->medico->plan == 'plan_agenda') Plan: Plan Mi Agenda @elseif(Auth::user()->medico->plan == 'plan_platino') Plan: Plan Platino
          @elseif(Auth::user()->medico->plan == 'plan_basico') Plan: Plan Basico
          @else @endif</span></strong></a>
        </div>
      @endif
      <div class="col-12">
        <a href="{{route('home')}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-home fa-2"></i><span>Inicio</a>
        </div>
      <div class="col-12">
        <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-thumbs-up"></i><span>Me gusta</span></a>
      </div>
      <div class="col-12">
        <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-gift"></i><span>Compartir</span></a>
      </div>
    </div>
    <div class="row py-1">

      <div class="col-12">

        @if (Auth::user()->medico->plan == 'plan_agenda' or Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          @if(Auth::user()->medico->plan == 'plan_agenda')
            <a href="{{route('appointments_confirmed', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span style="font-size:10px;background:rgb(222, 46, 8);border-radius:10px;padding:5px;border-color:white;">Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
          @else
            <a href="{{route('appointments', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-bell"></i> <span>Citas <span style="font-size:10px;background:rgb(222, 46, 8);border-radius:10px;padding:5px;border-color:white;">Nuevas ({{Auth::user()->medico->notification_number}})</span> </span></a>
          @endif
        @endif

      </div>
      <div class="col-12">
        <a href="{{route('medico.edit', Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-user fa-2"></i><span>Editar Perfil</span></a>
      </div>
      {{-- <div class="col-12">
        <a href="{{route('medico_diary',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-cogs"></i><span>Panel de control</span></a>
      </div> --}}


    <div class="col-12">

        <a href="{{route('medico_patients',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-address-card"></i><span>Pacientes</span></a>
      </div>

      <div class="col-12">
        <a href="{{route('calification_medic',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="far fa-list-alt"></i><span>Calificación</span></a>
      </div>

    </div >

    <div class="row">


      <div class="col-12">
        <a href="{{route('medico_diary',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-book"></i><span>Mi Agenda</span></a>
      </div>

      <div class="col-12">
        <a href="{{route('medico_schedule',Auth::user()->medico_id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-edit"></i><span>Editar Horario</span></a>
      </div>

      <div class="col-12">
        <a href="{{route('planes_medic',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Planes</span></a>
      </div>
      @if (Auth::user()->medico->plan == 'plan_agenda' or Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
      <div class="col-12">
        <a href="{{route('income_medic',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Ingresos</span></a>
      </div>
      <div class="col-12">
        <a href="{{route('medico_reminders',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Recordatorios</span></a>
      </div>
      @endif
      @if ( Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
      <div class="col-12">
        <a href="{{route('medico_assistants',Auth::user()->medico->id)}}" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-clipboard-list"></i><span>Asistentes</span></a>
      </div>
    @endif
      <div class="col-12">
        <a href="#" class="btn btn-block btn-config-dashboard color-medic"><i class="fas fa-mobile-alt"></i><span>Descarga tu app</span></a>
      </div>

    </div>
  </div>
  <!-- Hasta aqui -->
