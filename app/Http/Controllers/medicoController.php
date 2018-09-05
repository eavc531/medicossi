<?php

namespace App\Http\Controllers;
use App\patients_doctor;
use App\event;
use App\patient;
use App\medico;
use App\country;
use App\city;
use App\state;
use App\promoter;
use App\User;
use App\medicalCenter;
use App\specialty;
use App\specialty_category;
use App\photo;
use App\consulting_room;
use App\medico_specialty;
use Mail;
use App\medico_service;
use App\medico_experience;
use App\social_network;
use App\Role;
use App\insurance_carrier;
use App\question_lab;
use Geocoder;
use App\note;
use App\rate_medic;
use App\video;
use App\data_patient;
use DB;
use Session;
use Auth;
use App\expedient;
use App\file;
use App\salubridad_report;
use App\history;
use App\task_consultation;

use App\insurrance_show;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class medicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
      {
         // $this->middleware('authenticate', ['except' => ['edit','create','store']]);
      }
      /////////una redirecciona a la otra esto por q relleno un campo con ajax

      public function redierct_manage_patient(Request $request)
      {

          if($request->event_id != Null){

              if(Auth::user()->role == 'medico'){
                  $medico2 = medico::find(Auth::user()->medico_id);

                  if($medico2->event_id == $request->event_id) {
                      return redirect()->route('manage_patient',['m_id'=>\Hashids::encode($request->medico_id),'p_id'=>\Hashids::encode($request->patient_id),'event_id'=>\Hashids::encode($request->event_id)]);
                  }else{
                      $medico2->event_id = $request->event_id;
                      $medico2->save();
                      $event = event::find($request->event_id);
                      $fecha = \Carbon\Carbon::parse($event->start)->format('d-m-Y H:i');
                      return redirect()->route('manage_patient',['m_id'=>\Hashids::encode($request->medico_id),'p_id'=>\Hashids::encode($request->patient_id),'event_id'=>\Hashids::encode($request->event_id)])->with('success', 'Se ha Abierto la consulta: '.$event->title.' '.$fecha.' Paciente: '.$event->namePatient);
                  }
                      // $event_id = $request->event_id;

                  }elseif(Auth::user()->role == 'Asistente'){
                      $medico2 = medico::find(Auth::user()->assistant->medico_id);

                  }

          }else{
              return redirect()->route('manage_patient',['m_id'=>\Hashids::encode($request->medico_id),'p_id'=>\Hashids::encode($request->patient_id)]);
          }


      }

      public function manage_patient(Request $request,$m_id,$p_id)
      {
          if($request->event_id != Null){

              $event_id = \Hashids::decode($request->event_id)[0];
              if(Auth::user()->role == 'medico'){

                 $medico2 = medico::find(Auth::user()->medico_id);

              }elseif(Auth::user()->role == 'Paciente'){

                 $medico2 = medico::find(Auth::user()->assistant->medico_id);
              }

              if($medico2->event_id == Null){
                  $medico2->event_id = $event_id;
                  $medico2->save();
              }
          }

          $medico = medico::find($m_id);

          $patient = patient::find($p_id);
          $data_patient = data_patient::where('medico_id',$m_id)->where('patient_id',$p_id)->first();

          if($data_patient == Null){
              return redirect()->route('data_patient',['m_id'=>\Hashids::encode($m_id),'p_id'=>\Hashids::encode($p_id)])->with('warning', 'Antes de entrar al panel de gestion del paciente: '.$patient->nameComplete.' debe ingresar los siguientes datos.');
          }

          $appointments_all = event::where('medico_id',$m_id)->where('patient_id',$p_id)->whereNull('rendering')->where('title','!=', 'Ausente')->count();
          $appointments_no_confirmed = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->whereNull('rendering')->count();
          $appointments_confirmed = event::where('medico_id',$m_id)->where('patient_id',$p_id)->Where('confirmed_medico','Si')->where('state','!=' ,'Rechazada/Cancelada')->whereNull('rendering')->count();
          $appointments_past = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Pasada y sin realizar')->where('title','!=','Ausente')->count();
          $appointments_paid = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Pagada y Pendiente')->count();
          $appointments_cancel = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Rechazada/Cancelada')->whereNull('rendering')->count();
          $appointments_completed = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Pagada y Completada')->count();


          $medico = medico::find($m_id);
          // dd($request->patient_id);
          $notes = note::where('medico_id',$m_id)->where('patient_id', $patient->id)->count();
          $expedients = expedient::where('medico_id',$m_id)->where('patient_id', $patient->id)->count();
          $appointments_pending = event::where('medico_id',$m_id)->where('patient_id', $patient->id)->count();
          $data_patient = data_patient::where(['medico_id'=>$m_id,'patient_id'=>$p_id])->first();

          $note_count = note::where('medico_id',$m_id)->where('patient_id',$p_id)->count();
          $exp_count = expedient::where('medico_id',$m_id)->where('patient_id',$p_id)->count();
          $files_count = file::where('medico_id',$m_id)->where('patient_id',$p_id)->count();

          $salubridad_report = salubridad_report::where('medico_id',$medico->id)->where('patient_id',$patient->id)->first();

          //historial medicos
            $verifyhistory = history::where('medico_id',$medico->id)->where('patient_id',$patient->id)->first();

            if($verifyhistory != Null){
                $verifyhistory->delete();
            }

            $history = new history;
            $history->name = $patient->nameComplete;
            $history->medico_id = $medico->id;
            $history->patient_id =  $patient->id;
            $history->save();

            $historyCount = history::where('medico_id',$medico->id)->where('patient_id',$patient->id)->count();
            if($historyCount > 6){
                $history = history::where('medico_id',$medico->id)->where('patient_id',$patient->id)->orderBy('id','asc')->first()->delete();
            }

          return view('medico.patient.manage_patient',compact('notes','expedients','appointments_pending','patient','medico','data_patient','appointments_all','appointments_no_confirmed','appointments_past','appointments_paid','appointments_confirmed','appointments_cancel','appointments_completed','note_count','exp_count','files_count','salubridad_report'));
      }

      public function data_patient($m_id,$p_id){
          // dd('aqui');
        $states = state::orderBy('name','asc')->pluck('name','name');
        $cities = city::orderBy('name','asc')->pluck('name','name');
        $medico = medico::find($m_id);
        $patient = patient::find($p_id);

        $data_patient = data_patient::where(['medico_id'=>$m_id,'patient_id'=>$p_id])->first();

        return view('medico.patient.data_patient',compact('medico','patient','data_patient','states','cities'));

      }
      ////////////////////////////////

      public function data_patient_extract_perfil($m_id,$p_id){
        $states = state::orderBy('name','asc')->pluck('name','name');
        $cities = city::orderBy('name','asc')->pluck('name','name');
        $medico = medico::find($m_id);
        $patient = patient::find($p_id);
        $data_patient = patient::find($p_id);
        $extract = 'extraer';
        return view('medico.patient.data_patient',compact('medico','patient','data_patient','states','cities','extract'));

      }

      public function data_patient_store(Request $request){

        $request->validate([
          'identification'=>'required',
          'gender'=>'required',
          'name'=>'required',
          'lastName'=>'required',
          'phone1'=>'required|numeric',
          'phone2'=>'numeric|nullable',
          'email'=>'required|email',
          'country'=>'required',
          'state'=>'required',
          'city'=>'required',
          // 'postal_code'=>'required',
          'colony'=>'required',
          'street'=>'required',
        ]);

        if($request->city == 'opciones'){
          return back()->with('warning', 'El campo ciudad es requerido')->withInput();
        }

        $data_patient = data_patient::where('medico_id',$request->medico_id)->where('patient_id',$request->patient_id)->first();

        if($data_patient == Null){
          $data_patient = new data_patient;
          $data_patient->fill($request->all());
          $data_patient->nameComplete = $request->name.' '.$request->lastName;
          $age =  \Carbon\Carbon::parse($request->birthdate)->diffInYears(\Carbon\Carbon::now());
          $data_patient->age = $age;
          $data_patient->save();


        }else{
          $data_patient->fill($request->all());
          $data_patient->nameComplete = $request->name.' '.$request->lastName;
          $age =  \Carbon\Carbon::parse($request->birthdate)->diffInYears(\Carbon\Carbon::now());
          $data_patient->age = $age;
          $data_patient->save();

        }

          return redirect()->route('manage_patient',['m_id'=>\Hashids::encode($request->medico_id),'p_id'=>\Hashids::encode($request->patient_id)])->with('success','Se han Guardado los Datos Personales del Paciente');

      }

     public function add_patient_registered(Request $request){
       $patients_doctor = patients_doctor::where('medico_id', $request->medico_id)->where('patient_id',$request->patient_id)->first();
       $patient = patient::find($request->patient_id);
       if($patients_doctor == Null){
         // $medico = medico::find($request->medico_id);
         $patient = patient::find($request->patient_id)->toArray();

         $data_patient = new data_patient;
         // dd($patient);
         $data_patient->fill($patient);
         $data_patient->nameComplete = $patient['name']." ".$patient['lastName'];
         $data_patient->save();

         $patients_doctor = new patients_doctor;
         $patients_doctor->medico_id = $request->medico_id;
         $patients_doctor->patient_id = $request->patient_id;
         $patients_doctor->data_patient_id = $data_patient->id;
         $patients_doctor->save();

         return back()->with('success', 'Se ha agregado el Paciente: '.$patient['nameComplete'].' a su lista de pacientes');
       }
        return back()->with('warning', 'el Paciente: '.$patient->nameComplete.' ya esta registrado en su lista de pacientes');
     }

     public function medico_store_new_patient(Request $request)
     {
       $request->validate([
         'identification'=>'required|unique:patients',
         'gender'=>'required',
         'name'=>'required',
         'lastName'=>'required',
         'phone1'=>'required|numeric',
         'phone2'=>'numeric|nullable',
         'email'=>'required|email|unique:patients',
         'country'=>'required',
         'state'=>'required',
         'city'=>'required',
         // 'postal_code'=>'required',
         'colony'=>'required',
         'street'=>'required',
       ]);

       if($request->city == 'opciones'){
         return back()->with('warning', 'El campo ciudad es requerido')->withInput();
       }

       $Coordinates = Geocoder::getCoordinatesForAddress($request->country.','.$request->city.','.$request->colony.','.$request->street.','.$request->number_ext);

       $patient = new patient;
       $patient->fill($request->all());
       $patient->nameComplete = $request->name.' '.$request->lastName;
       $patient->country = $request->country;
       $patient->state = $request->state;
       $patient->city = $request->city;
       $patient->postal_code = $request->postal_code;
       $patient->colony = $request->colony;
       $patient->street = $request->street;
       $patient->number_ext = $request->number_ext;
       $patient->number_int = $request->number_int;
       $patient->longitud = $Coordinates['lng'];
       $patient->latitud = $Coordinates['lat'];
       $patient->stateConfirm = 'complete';
       $patient->save();

       $user = new User;
       $user->name = $request->name;
       $user->email = $request->email;

       $password = str_random(8);
       $user->password = bcrypt($password);
       $user->password_send = bcrypt($password);
       $user->patient_id = $patient->id;
       $user->role = 'Paciente';
       $user->save();

       $role = Role::where('name','patient')->first();

       $user->attachRole($role);

        $medico = medico::find($request->medico_id);

       $data_patient = new data_patient;
       $data_patient->fill($request->all());
       $data_patient->medico_id = $medico->id;
       $data_patient->patient_id = $patient->id;
       $data_patient->nameComplete = $request->name.' '.$request->lastName;
       $age =  \Carbon\Carbon::parse($request->birthdate)->diffInYears(\Carbon\Carbon::now());
       $data_patient->age = $age;
       $data_patient->save();

       $patients_doctor = new patients_doctor;
       $patients_doctor->medico_id = $request->medico_id;
       $patients_doctor->patient_id = $patient->id;
       $patients_doctor->data_patient_id = $data_patient->id;
       $patients_doctor->save();

       Mail::send('mails.medico_register_new_patient',['patient'=>$patient,'medico'=>$medico,'user'=>$user],function($msj) use($patient){
          $msj->subject('Médicos Si');
          $msj->to($patient->email);
          // $msj->to('eavc53189@gmail.com');

        });

       return redirect()->route('medico_patients',\Hashids::encode($request->medico_id))->with('success','Se a registrado el paciente '.$patient->nameComplete.' de forma satisfactoria. Se ha enviado un mensaje al correo electronico asociado,con los datos necesarios para que el paciente pueda acceder a la cuenta creada, si asi lo desea, en donde podra ver el estado de sus citas, calificarle como médico en el sistema, agendar citas y mas.');
     }

     public function medico_register_new_patient($id)
     {
       $medico = medico::find($id);
       $states = state::orderBy('name','asc')->pluck('name','name');
       $cities = city::orderBy('name','asc')->pluck('name','name');

       return view('medico.patient.medico_register_new_patient',compact('medico','states','cities'));
     }

     public function add_image($id){
       $medico = medico::find($id);
       $images = photo::where('medico_id', $medico->id)->where('type','image')->get();

       return view('medico.includes_perfil.add_image',compact('medico','images'));
     }

     public function patients_registered($id)
     {
         $medico = medico::find($id);
         $patients = patient::where('stateConfirm','complete')->orderBy('name','asc')->get();

           $data = [];
           foreach ($patients as $patient){
           $patients_doctors = patients_doctor::where('medico_id', $medico->id)->where('patient_id', $patient->id)->get();
           if($patients_doctors->first() == null){
             $photo = photo::where('patient_id',$patient->id)->where('type', 'perfil')->first();
             if($photo == Null){
               $image = Null;
             }else{
               $image = $photo->path;
             }

             $data[$patient->id] = ['id'=>$patient->id,'identification'=>$patient->identification,'name'=>$patient->name,'lastName'=>$patient->lastName,'city'=>$patient->city,'state'=>$patient->state,'image'=>$image];

             }
           }

           $currentPage = LengthAwarePaginator::resolveCurrentPage();
           $col = new Collection($data);
           $perPage = 10;

           $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
           $patients = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
           $patients->setPath(route('patients_registered',$medico->id));

         return view('medico.patient.patients_registered',compact('medico','patients'));

     }

     public function search_patients_registered(Request $request){

       $patients = DB::table('patients')
       ->select('patients.*')
       ->where(function($query) use($request){
          $query->where('patients.nameComplete','LIKE','%'.$request->search.'%')->where('stateConfirm', 'complete');
         })->orWhere(function($query) use($request){
            $query->where('patients.identification',$request->search)
            ->where('stateConfirm', 'complete');
          })->get();
          $medico = medico::find($request->medico_id);

          $data = [];
          foreach ($patients as $patient) {
            $patients_doctors = patients_doctor::where('medico_id', $medico->id)->where('patient_id', $patient->id)->get();
            if($patients_doctors->first() == null){
          $photo = photo::where('patient_id',$patient->id)->where('type', 'perfil')->first();
          if($photo == Null){
            $image = Null;
          }else{
            $image = $photo->path;
          }

          $data[$patient->id] = ['id'=>$patient->id,'identification'=>$patient->identification,'name'=>$patient->name,'lastName'=>$patient->lastName,'city'=>$patient->city,'state'=>$patient->state,'image'=>$image];
        }
          }

          $currentPage = LengthAwarePaginator::resolveCurrentPage();
          $col = new Collection($data);
          $perPage = 10;

          $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
          $patients = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
          $patients->setPath(route('patients_registered',$medico->id));

        return view('medico.patient.patients_registered',compact('medico','patients'));

     }

     public function medico_patients($id)
     {
         $medico = medico::find($id);

         $patients = patients_doctor::Join('medicos', 'patients_doctors.medico_id', '=', 'medicos.id')
                                     ->Join('patients', 'patients_doctors.patient_id', '=', 'patients.id')
                                     ->select('patients.*','patients_doctors.id as patients_doctor_id')
                                     ->where('medicos.id',$id)
                                     ->orderBy('patients.name','asc')
                                     ->get();
                                     // dd($patients);

           $data = [];
           foreach ($patients as $patient) {
           $photo = photo::where('patient_id',$patient->id)->where('type', 'perfil')->first();
           if($photo == Null){
             $image = Null;
           }else{
             $image = $photo->path;
           }

           $data[$patient->id] = ['id'=>$patient->id,'identification'=>$patient->identification,'name'=>$patient->name,'lastName'=>$patient->lastName,'city'=>$patient->city,'state'=>$patient->state,'image'=>$image];

           }

           $currentPage = LengthAwarePaginator::resolveCurrentPage();
           $col = new Collection($data);
           $perPage = 10;

           $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
           $patients = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
           $patients->setPath(route('tolist2'));


         return view('medico.patient.medico_patients',compact('medico','patients'));

     }

     public function search_patients(Request $request){

       $patients = DB::table('patients_doctors')
       ->Join('medicos', 'patients_doctors.medico_id', '=', 'medicos.id')
       ->Join('patients', 'patients_doctors.patient_id', '=', 'patients.id')
       ->select('patients.*')
       ->where(function($query) use($request){
          $query->where('medico_id',$request->medico_id)
          ->where('patients.nameComplete','LIKE','%'.$request->search.'%');
         })->orWhere(function($query) use($request){
            $query->where('medico_id',$request->medico_id)
            ->where('patients.identification','LIKE','%'.$request->search.'%');
          })->get();

          $medico = medico::find($request->medico_id);

          $data = [];
          foreach ($patients as $patient) {
          $photo = photo::where('patient_id',$patient->id)->where('type', 'perfil')->first();
          if($photo == Null){
            $image = Null;
          }else{
            $image = $photo->path;
          }

          $data[$patient->id] = ['id'=>$patient->id,'identification'=>$patient->identification,'name'=>$patient->name,'lastName'=>$patient->lastName,'city'=>$patient->city,'state'=>$patient->state,'image'=>$image];

          }

          $currentPage = LengthAwarePaginator::resolveCurrentPage();
          $col = new Collection($data);
          $perPage = 10;
          $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
          $patients = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
          $patients->setPath(route('tolist2'));


        return view('medico.patient.medico_patients',compact('medico','patients'));

     }

     public function calification_medic($id){

      $medico = medico::find($id);
      // $type = 'no_vistas';
      $rate_medic = rate_medic::where('medico_id',$id)->whereNull('views')->paginate(5);
      // $rate_medic2 = rate_medic::where('medico_id',$id)->where('viewed','No')->paginate(5);

       return view('medico.calification.calification_medic',compact('rate_medic','medico','rate_medic2','type'));

     }
     public function calification_medic_viewed($id){
         $medico = medico::find($id);
         $views = 'no_vistas';
         $rate_medic = rate_medic::where('medico_id',$id)->where('views','si')->paginate(5);
       return view('medico.calification.calification_medic',compact('rate_medic','medico','rate_medic2','views'));
     }

     public function medico_create_add_insurrances(Request $request,$id){

       $insurrance_show = insurrance_show::orderBy('name','asc')->get();
       $insurances = insurance_carrier::where('medico_id',$id)->get();
       return view('medico.create_add_insurrances')->with('insurrance_show', $insurrance_show)->with('insurances', $insurances);
     }

     public function medico_store_insurrances(Request $request,$id){

       $request->validate([
         'name'=>'required|'.Rule::unique('insurance_carriers')->where('medico_id',$id),
       ]);

       $insurance = new insurance_carrier;
       $insurance->name = $request->name;
       $insurance->medico_id = $id;
       $insurance->save();

       return back()->with('success', 'Aseguradora agregada con exito');
     }

     public function select_insurrances2(Request $request){

       $medico = medico::find($request->medico_id);
       $medico->type_patient_service = $request->type_patient_service;
       $medico->save();
       return response()->json($request->type_patient_service);

     }

     public function verify_past_appointment($id){
         $verify_past_appointment = event::where('medico_id',$id)->where('end','<', \Carbon\Carbon::now())->where('confirmed_medico','Si')->where('state', 'Pendiente')->get();

         foreach ($verify_past_appointment as $value) {
             // $value->color = 'rgb(190, 61, 13)';
             $value->state = 'Pasada y sin realizar';
             $value->save();
         }
         // rgb(190, 61, 13)

     }

     public function appointments_all($id){

      medicoController::verify_past_appointment($id);
       $appointments = event::where('medico_id',$id)->whereNull('rendering')->where('title','!=', 'Ausente')->orderBy('start','desc')->paginate(5);
       $type = 'todas';
       $medico = medico::find($id);
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function appointments($id){
         medicoController::verify_past_appointment($id);
       $medico = medico::find($id);

       $appointments = event::where('medico_id',$id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->whereNull('rendering')->orderBy('start','desc')->paginate(5);
       $type = 'sin confirmar';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function appointments_past_collect($id){
         medicoController::verify_past_appointment($id);
       $medico = medico::find($id);
       $appointments = event::where('medico_id',$id)->where('state','Pasada y sin realizar')->where('title','!=','Ausente')->orderBy('start','desc')->paginate(5);

       $type = 'Pasada y sin realizar';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function app_realizada_por_cobrar($id){
        medicoController::verify_past_appointment($id);

       $medico = medico::find($id);
       $appointments = event::where('medico_id',$id)->where('state','Realizada y por cobrar')->where('title','!=','Ausente')->orderBy('start','desc')->paginate(5);
       $type = 'Realizadas y por cobrar';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function appointments_paid_and_pending($id){
         medicoController::verify_past_appointment($id);
       $medico = medico::find($id);
       $appointments = event::where('medico_id',$id)->where('state','Pagada y Pendiente')->orderBy('start','desc')->paginate(5);
       $type = 'Pagadas y Pendientes';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function appointments_confirmed($id){
         medicoController::verify_past_appointment($id);
       $medico = medico::find($id);
       $appointments = event::where('medico_id',$id)->Where('confirmed_medico','Si')->where('state','!=' ,'Rechazada/Cancelada')->whereNull('rendering')->orderBy('start','desc')->paginate(5);
       $type = 'confirmadas';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function appointments_canceled($id){
         medicoController::verify_past_appointment($id);
       $medico = medico::find($id);
       $appointments = event::where('medico_id',$id)->where('state','Rechazada/Cancelada')->whereNull('rendering')->orderBy('start','desc')->paginate(5);
       $type = 'canceladas';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     public function appointments_completed($id){
         medicoController::verify_past_appointment($id);
       $medico = medico::find($id);
       $appointments = event::where('medico_id',$id)->where('state','Pagada y Completada')->orderBy('start','desc')->paginate(5);
       $type = 'Pagadas y Completadas';
       return view('medico.appointments.appointments',compact('appointments','type','medico'));

     }

     ///////////

     public function patient_app_realizada_por_cobrar($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
         $medico = medico::find($m_id);
         $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Realizada y por cobrar')->where('title','!=','Ausente')->orderBy('start','desc')->paginate(5);

         $type = 'Realizadas y por cobrar';
         $patient = patient::find($p_id);
         
         return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_all($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->whereNull('rendering')->where('title','!=', 'Ausente')->orderBy('start','desc')->paginate(5);
       $type = 'todas';
       $medico = medico::find($m_id);
       $patient = patient::find($p_id);
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_no_confirmed($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $medico = medico::find($m_id);
       $patient = patient::find($p_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('confirmed_medico','No')->where('state','!=', 'Rechazada/Cancelada')->whereNull('rendering')->orderBy('start','desc')->paginate(5);
       $type = 'sin confirmar';
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_past_collect($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $medico = medico::find($m_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Pasada y sin realizar')->where('title','!=','Ausente')->orderBy('start','desc')->paginate(5);

       $type = 'Pasada y sin realizar';
       $patient = patient::find($p_id);
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_paid_and_pending($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $medico = medico::find($m_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Pagada y Pendiente')->orderBy('start','desc')->paginate(5);
       $type = 'Pagadas y Pendientes';
       $patient = patient::find($p_id);
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_confirmed($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $medico = medico::find($m_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->Where('confirmed_medico','Si')->where('state','!=' ,'Rechazada/Cancelada')->whereNull('rendering')->orderBy('start','desc')->paginate(5);
       $type = 'confirmadas';
       $patient = patient::find($p_id);
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_canceled($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $medico = medico::find($m_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Rechazada/Cancelada')->whereNull('rendering')->orderBy('start','desc')->paginate(5);
       $type = 'canceladas';
       $patient = patient::find($p_id);
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     public function patient_appointments_completed($m_id,$p_id){
         medicoController::verify_past_appointment($m_id);
       $medico = medico::find($m_id);
       $appointments = event::where('medico_id',$m_id)->where('patient_id',$p_id)->where('state','Pagada y Completada')->orderBy('start','desc')->paginate(5);
       $type = 'Pagadas y Completadas';
       $patient = patient::find($p_id);
       return view('medico.patient.medico_patient_appointments',compact('appointments','type','medico','patient'));

     }

     ///////// END
     public function medico_note_edit($m_id,$p_id,$n_id){
       $note = note::find($n_id);
       $medico = medico::find($m_id);
       $patient = patient::find($p_id);

       return view('medico.edit_note',compact('note','medico','patient'));
     }

     public function note_store(Request $request)
     {

        $note = new note;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->patient_id = $request->patient_id;
        $note->medico_id = $request->medico_id;
        $note->type_note = 'saved';
        $note->save();




         return redirect()->route('admin_data_patient',['med_id'=>\Hashids::encode($request->medico_id), 'p_id'=>\Hashids::encode($request->patient_id)])->with('success', 'Nota Guardada de Forma Exitosa.');
     }


     public function admin_data_patient($id_medico,$id_patient)
     {
         $patient = patient::find($id_patient);
         $medico = medico::find($id_medico);
         $noteMedicIniCount = note::where('type_note', 'customized')->where('medico_id', $id_medico)->where('type_note', 'customized')->count();

         if($noteMedicIniCount == 0){
           $noteMedicIni = note::where('type_note', 'system')->where('title', 'Nota Médica Inicial')->first();
         }else{
           $noteMedicIni = note::where('type_note', 'customized')->where('medico_id', $id_medico)->where('title', 'Nota Médica Inicial')->first();
         }

         return view('medico.admin_data_patient',compact('patient','medico','noteMedicIni'));
     }

     public function create_note_patient($id_medico,$id_patient,$id_note)
     {
         $states = state::orderBy('name','asc')->pluck('name','name');
         $cities = city::orderBy('name','asc')->pluck('name','name');
         $patient = patient::find($id_patient);

         $medico = medico::find($id_medico);
         $note = note::find($id_note);

         return view('medico.create_note_patient',compact('patient','medico','note','states','cities'));
     }

     public function medico_edit_address($id){
       $medico = medico::find($id);
       $cities = city::orderBy('name','asc')->pluck('name','name');
       $states = state::orderBy('name','asc')->pluck('name','name');
        return view('medico.edit_address')->with('medico', $medico)->with('cities', $cities)->with('states', $states);
     }

     public function medico_update_address(Request $request,$id){


         $request->validate([
           'country'=>'required',
           'state'=>'required',
           'city'=>'required',
           'postal_code'=>'required',
           'colony'=>'required',
           'street'=>'required',
           'type_consulting_room'=>'required'
           // 'number_ext'=>'required',
         ]);

         if($request->type_consulting_room == 'Otro Especifique:'){
           if($request->otro == Null){
             return back()->with('warning', 'Debes especificar el tipo de Consultiorio');
           }
           $type_consulting_room = $request->otro;
         }else{
           $type_consulting_room = $request->type_consulting_room;
         }


          if($request->city == 'opciones'){
            return back()->with('warning', 'El campo ciudad es requerido')->withInput();
          }
           // $Coordinates =
           //  Geocoder::getCoordinatesForAddress($request->number_ext,$request->street,$request->colony,$request->city,$request->state,$request->country);

            $Coordinates = Geocoder::getCoordinatesForAddress($request->country.','.$request->city.','.$request->colony.','.$request->street.','.$request->number_ext);

           $state = state::where('name',$request->state)->first();

           $city = city::where('name',$request->city)->first();

           $medico = medico::find($id);
           if($medico->stateConfirm != 'data_primordial_complete' and $medico->stateConfirm != 'complete'){
             return redirect()->route('data_primordial_medico',\Hashids::encode($id))->with('warning', 'Debes rellenar los siguietnes Datos para Poder acceder a otros paneles de tu cuenta.');
           }
           $medico->country = $request->country;
           $medico->state = $request->state;
           $medico->city = $request->city;
           $medico->state_id = $state->id;
           $medico->city_id = $city->id;
           $medico->postal_code = $request->postal_code;
           $medico->colony = $request->colony;
           $medico->street = $request->street;
           $medico->number_ext = $request->number_ext;
           $medico->number_int = $request->number_int;
           $medico->longitud = $Coordinates['lng'];
           $medico->latitud = $Coordinates['lat'];
           $medico->name_comercial = $request->name_comercial;
           $medico->password_unique = $request->password_unique;
           $medico->type_consulting_room = $type_consulting_room;
           $medico->save();

           if($medico->stateConfirm == 'data_primordial_complete'){
             $medico->stateConfirm = 'complete';
             $medico->save();
             return redirect()->route('medico.edit',\Hashids::encode($id))->with('successComplete','nada');
           }

        return redirect()->route('medico.edit',\Hashids::encode($medico->id))->with('medico', $medico)->with('success','Se ha actualizado la Dirección de su sitio de trabajo');
     }



     public function inner_cities_select(Request $request){
       $cities = city::where('state_id',$request->state_id)->orderBy('name','asc')->pluck('name','id');
       return $cities;
     }

     public function inner_cities_select2(Request $request){
       $cities = city::where('state_id',$request->state_id)->orderBy('name','asc')->pluck('name','name');
       return $cities;
     }

     public function inner_cities_select3(Request $request){
       $state = state::where('name', $request->name)->first();
       $cities = city::where('state_id',$state->id)->orderBy('name','asc')->pluck('name','name');
       return $cities;
     }

     public function inner_states_select(Request $request){

       $state = state::where('name', $request->name)->first();
       $cities = city::where('state_id',$state->id)->orderBy('name','asc')->pluck('name','name');
       return $cities;
     }

     public function medico_specialty_delete($id)
     {
       $medico_specialty = medico_specialty::find($id);

       $medico_specialty->delete();

       return back()->with('danger', 'Especialidad Eliminada');
     }

     public function medico_specialty_create($id)
     {
         return view('medico.medico_specialty.create')->with('medico_id',$id);
     }

     public function medico_specialty_edit($id)
     {
       $specialty = medico_specialty::find($id);
         return view('medico.medico_specialty.edit',compact('specialty'))->with('medico_id',$id);
     }

     public function medico_specialty_update(Request $request,$id){

       $request->validate([
         'type'=>'required',
         'institution'=>'required',
         'specialty'=>'required',
         'from'=>'required',
         'until'=>'required',
         'state'=>'required',
         'aditional'=>'nullable',
       ]);


       if($request->type == 'other'){
         $request->validate([
           'other'=>'required'
         ]);

       }

       // $specialty = specialty::where('name',$request->specialty)->first();
       //
       $medico_specialty = medico_specialty::find($id);
       $medico_specialty->fill($request->all());

       if($request->type == 'other'){

         $medico_specialty->type = $request->other;
       }else{

         $medico_specialty->type = $request->type;
       }
       $medico_specialty->save();

       return redirect()->route('medico.edit',\Hashids::encode($request->medico_id))->with('success','la información se ha actualizado de forma satisfactoria.');

     }

     public function medico_specialty_store(Request $request){

       $request->validate([
         'type'=>'required',
         'institution'=>'required',
         'specialty'=>'required',
         'from'=>'required',
         'until'=>'required',
         'state'=>'required',
         'aditional'=>'nullable',
       ]);

       if($request->type == 'other'){
         $request->validate([
           'other'=>'required'
         ]);

       }

       // $specialty = specialty::where('name',$request->specialty)->first();
       //

       $medico_specialty = new medico_specialty;
       $medico_specialty->fill($request->all());

       if($request->type == 'other'){
         $medico_specialty->type = $request->other;
       }else{
         $medico_specialty->type = $request->specialty;
       }
       $medico_specialty->save();

       return redirect()->route('medico.edit',\Hashids::encode($request->medico_id))->with('success','Se ha Agregado una nueva Especialidad/Carrera, de forma satisfactoria.');

     }
     public function data_primordial_medico($id){
         if(Auth::check() or Auth::user()->role == 'medico'){
             if(Auth::user()->medico_id == $id){

             }else{
                 return redirect()->route('home')->with('warning', 'No tienes permisos, o se cerrado su sesión');
             }
         }elseif(Auth::user()->role == 'Asistente') {
             if(Auth::user()->assistant->medico_id == $id){

             }else{
                 return redirect()->route('home')->with('warning', 'No tienes permisos, o se cerrado su sesión');
             }
         }else{
             return redirect()->route('home')->with('warning', 'No tienes permisos, o se cerrado su sesión');
         }


       $medico = medico::find($id);
       $cities = city::orderBy('name','asc')->pluck('name','id');
       $states = state::orderBy('name','asc')->pluck('name','id');
        $specialties = specialty::orderBy('name','asc')->pluck('name','name');
      return view('medico.data_primordial_medico',compact('medico','cities','states','specialties'));
     }

    public function medico_service_list(Request $request){

        $medico_services = medico_service::where('medico_id', $request->medico_id)->orderBy('id','desc')->orderBy('id','desc')->get();

        return view('medico.includes_perfil.list_service',compact('medico_services'));

    }

    public function medico_experience_delete(Request $request){
      $medico_service = medico_experience::find($request->medico_id);
      $medico_service->delete();

      return response()->json($medico_service);

    }

    public function medicoBorrar(Request $request){
      $medico_service = medico_service::find($request->medico_id);
      $medico_service->delete();

      return response()->json($medico_service);

    }

     public function social_network_list(Request $request){
         $social_networks = social_network::where('medico_id', $request->medico_id)->get();

         return view('medico.includes_perfil.list_social')->with('social_networks', $social_networks);
     }


     public function medico_experience_list(Request $request){


        $experiences = medico_experience::where('medico_id', $request->medico_id)->orderBy('id','desc')->get();

         return view('medico.includes_perfil.list_experience',compact('experiences'));

     }

     public function borrar_social(Request $request){
       $social_network = social_network::find($request->id);
       $social_network->delete();

      return response()->json($request->id);
     }

     public function medico_social_network_store(Request $request)
     {

         $request->validate([
           'name'=>'required|'.Rule::unique('social_networks')->where('medico_id',$request->medico_id),
           'link'=>'required'
         ]);

         $social_network = new social_network;
         $social_network->name = $request->name;
         $social_network->link = $request->link;
         $social_network->medico_id = $request->medico_id;
         $social_network->save();

         return response()->json('ok');
     }

     public function medico_experience_store(Request $request)
     {
         $request->validate([
           'name'=>'required',
         ]);

         $medico_experience = new medico_experience;
         $medico_experience->name = $request->name;
         $medico_experience->medico_id = $request->medico_id;
         $medico_experience->save();

         return redirect()->route('medico.edit',\Hashids::encode($request->medico_id))->with('success', 'Experiencia Agregada');

     }
     public function service_medico_store(Request $request)
     {
         $request->validate([
           'name'=>'required',
         ]);

         $medico_service = new medico_service;
         $medico_service->name = $request->name;
         $medico_service->medico_id = $request->medico_id;
         $medico_service->save();

         return redirect()->route('medico.edit',\Hashids::encode($request->medico_id))->with('success', 'Servicio Agregado');

     }

    public function index()
    {
        //
    }

    public function medicosList()
    {
        $medicos = medico::orderBy('id','desc')->paginate(10);
        return view('medico.medicosList')->with('medicos',$medicos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $countries = country::orderBy('name','asc')->pluck('name','name');
      $specialties = specialty::orderBy('name','asc')->pluck('name','name');

      return view('medico.create',compact('countries','specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



     public function confirmMedico($id,$code){

      $user = User::find($id);

      if($user->confirmation_code == $code){
          $user->confirmation_code = $code;
          $user->confirmed = 'medium';
          $user->save();

          $medico = medico::find($user->medico_id);

          $medico->stateConfirm = 'medium';
          $medico->save();

          return redirect()->route('home')->with('confirmMedico', 'confirmMedico');

      }

          $user->save();
         return redirect()->route('successRegMedico',\Hashids::encode($user->medico_id))->with('warning', 'No se pudo verificar la autenticacion del usuario,por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');

     }

    public function store(Request $request)
    {
        $request->validate([
           //'identification'=>'required|unique:medicos',
           'name'=>'required',
           'lastName'=>'required',
           'gender'=>'required',
           'specialty'=>'required',
           'country'=>'required',
           'email'=>'email|required|unique:medicos|unique:users',
           'password'=>'required',
           //'medicalCenter_id'=>'required',
           //'id_promoter'=>'nullable',
           'phone'=>'required|numeric',
           //'facebook'=>'required',
        ]);

        if($request->terminos == Null){
          return back()->with('warning', 'Debes Aceptar los Términos y Condiciones, para poder continuar.')->withInput();
        }

        $medico = new medico;
        $medico->fill($request->all());
        $medico->nameComplete = $medico->name.' '.$medico->lastName;
        $medico->password = bcrypt($request->password);
        $medico->stateConfirm = 'porConfirmar';
        $specialty = specialty::where('name', $request->specialty)->first();
        $medico->specialty_category = $specialty->specialty_category->name;
        $medico->save();

        $code = str_random(25);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->medico_id = $medico->id;
        $user->confirmation_code = $code;
        $user->role = 'medico';
        $user->save();

        $role = Role::where('name','medico')->first();

        $user->attachRole($role);

         Mail::send('mails.confirmMedico',['medico'=>$medico,'user'=>$user,'code'=>$code],function($msj) use($medico){
           $msj->subject('Médicos Si');
           $msj->to($medico->email);
           // $msj->to('eavc53189@gmail.com');

      });

         return redirect()->route('successRegMedico',\Hashids::encode($medico->id))->with('user', $user)->with('medico', $medico);

    }

    public function successRegMedico($id)
    {
      $medico = medico::find($id);
      $user = User::where('medico_id',$id)->get();

        return view('medico.successReg')->with('user', $user)->with('medico', $medico);
    }

    public function resendMailMedicoConfirm($id){


         $code = str_random(25);
         $user = User::find($id);
         $medico = medico::find($user->medico_id);
         $user->confirmation_code = $code;
         $user->save();

         Mail::send('mails.confirmMedico',['medico'=>$medico,'user'=>$user,'code'=>$code],function($msj) use($medico){
            $msj->subject('Médicos Si');
            $msj->to($medico->email);
            // $msj->to('eavc53189@gmail.com');
        });

        return redirect()->route('successRegMedico',\Hashids::encode($medico->id))->with('success', 'Se ha reenviado el mensaje de confirmación al correo electronico asociado a tu cuenta MédicosSi')->with('user', $user);
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


     public function medico_perfil($id)
     {
       $insurance_carrier = insurance_carrier::where('medico_id',$id)->get();
       $medicalCenter = medicalCenter::orderBy('name','asc')->pluck('name','name');
       $cities = city::orderBy('name','asc')->pluck('name','id');
       $states = state::orderBy('name','asc')->pluck('name','id');
       $medico = medico::find($id);

       // if($medico->plan != 'plan_profesional' and $medico->plan != 'plan_platino'){
       //
       //   $medico->showNumber
       //   $medico->showNumber = 'no';
       //   $medico->showNumberOffice = 'no';
       //   $medico->save();
       // }


       $consulting_room = consulting_room::where('medico_id',$medico->id)->get();
       $consultingIsset = consulting_room::where('medico_id',$medico->id)->count();
       $photo = photo::where('medico_id', $medico->id)->where('type', 'perfil')->first();
       $medico_specialty = medico_specialty::where('medico_id', $medico->id)->paginate(10);
       $social_networks = social_network::where('medico_id', $id)->get();
       $images = photo::where('medico_id', $medico->id)->where('type','image')->get();
       $specialties = specialty::orderBy('name','asc')->pluck('name','name');

       return view('medico.perfil')->with('medico', $medico)->with('photo', $photo)->with('consulting_rooms', $consulting_room)->with('consultingIsset', $consultingIsset)->with('cities', $cities)->with('medicalCenter', $medicalCenter)->with('medico_specialty', $medico_specialty)->with('social_networks', $social_networks)->with('images', $images)->with('insurance_carrier',$insurance_carrier)->with('states', $states)->with('specialties', $specialties)->with('consulting_room',$consulting_room);
     }

    public function edit($id)
    {


        $insurance_carrier = insurance_carrier::where('medico_id',$id)->get();
        $medicalCenter = medicalCenter::orderBy('name','asc')->pluck('name','name');
        $cities = city::orderBy('name','asc')->pluck('name','id');
        $states = state::orderBy('name','asc')->pluck('name','id');
        $medico = medico::find($id);

            // if($medico->plan != 'plan_profesional' and $medico->plan != 'plan_platino'){
            //
            //   $medico->showNumber
            //   $medico->showNumber = 'no';
            //   $medico->showNumberOffice = 'no';
            //   $medico->save();
            // }


        $consulting_room = consulting_room::where('medico_id',$medico->id)->get();
        $consultingIsset = consulting_room::where('medico_id',$medico->id)->count();
        $photo = photo::where('medico_id', $medico->id)->where('type', 'perfil')->first();
        $medico_specialty = medico_specialty::where('medico_id', $medico->id)->paginate(10);
        $social_networks = social_network::where('medico_id', $id)->get();
        $images = photo::where('medico_id', $medico->id)->where('type','image')->get();
        $specialties = specialty::orderBy('name','asc')->pluck('name','name');




        return view('medico.edit')->with('medico', $medico)->with('photo', $photo)->with('consulting_rooms', $consulting_room)->with('consultingIsset', $consultingIsset)->with('cities', $cities)->with('medicalCenter', $medicalCenter)->with('medico_specialty', $medico_specialty)->with('social_networks', $social_networks)->with('images', $images)->with('insurance_carrier',$insurance_carrier)->with('states', $states)->with('specialties', $specialties)->with('consulting_room',$consulting_room);
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

      // /return $request;
      $request->validate([
         'name'=>'required',
         'lastName'=>'required',
         'gender'=>'required',
         // 'city_id'=>'required',
         // 'state_id'=>'required',
         'identification'=>'required',
         'specialty'=>'required',
         //'sub_specialty'=>'required',
         //'email'=>'required|unique:medicos|unique:users',
         //'password'=>'required',
         //'medicalCenter_id'=>'required',
         'id_promoter'=>'nullable',
         'phone'=>'required|numeric',
      ]);
      $city = city::find($request->city_id);

      $medico = medico::find($id);
      $medico->fill($request->all());
      $medico->nameComplete = $medico->name.' '.$medico->lastName;
      // $medico->latitud = $city->latitud;
      // $medico->longitud = $medico->longitud;
      //$medico->state = 'complete';
      $specialty = specialty::where('name', $request->specialty)->first();
      $medico->specialty_category = $specialty->specialty_category->name;


      if($medico->stateConfirm == 'complete'){
        $medico->save();
          return redirect()->route('medico.edit',\Hashids::encode($id))->with('success','Sus datos han sido actualizados con exito');
      }else{
        $medico->stateConfirm = 'data_primordial_complete';
        $medico->save();

          return redirect()->route('medico_edit_address',\Hashids::encode($id))->with('success', 'Sus datos han sido Guardados con exito, por Favor Agregue su dirección de trabajo.');
          // return redirect()->route('medico.edit',$id)->with('successComplete', 'valusse');
      }

      // if($medico->stateConfirm == 'mailConfirmed')
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

    public function medico_store_coordinates(Request $request,$id)
    {
      $medico = medico::find($id);
      $medico->longitud = $request->longitud;
      $medico->latitud = $request->latitud;
      $medico->save();

      return response()->json('ok');

    }



    public function medico_appointments_patient($medico_id,$patient_id)
    {
        $medico = medico::find($medico_id);
        $patient = patient::find($patient_id);
        $appointments = event::where('medico_id', $medico_id)->where('patient_id',$patient_id)->orderBy('created_at','desc')->paginate(4);

        return view('medico.patient.medico_patient_appointments',compact('medico','patient','appointments'));

    }

    public function marcar_como_vista($id)
    {

        $appointment = event::find($id);
        $appointment->notification = 'see';
        $appointment->save();

        $event = event::where('medico_id',$appointment->medico_id)->where('notification', 'not_see')->count();

        $medico = medico::find($appointment->medico_id);
        $medico->notification_number = $event;
        $medico->save();

        return back()->with('success','Se ha Maracado como vista la Cita para el Paciente: '.$appointment->namePatient.' Estipulada para la Fecha: '.$appointment->start);

    }

    // public function marcar_como_vista_redirect($m_id,$p_id,$app_id)
    // {
    //
    //     $app = event::find($app_id);
    //     $app->notification = 'see';
    //     $app->save();
    //
    //     $event = event::where('medico_id',$app->medico_id)->where('notification', 'not_see')->count();
    //
    //     $medico = medico::find($app->medico_id);
    //     $medico->notification_number = $event;
    //     $medico->save();
    //
    //     return redirect()->route('edit_appointment',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id,'app_id'=>$app->id])->with('success','Se ha Marcado como vista la Cita para el Paciente: '.$app->namePatient.' Estipulada para la Fecha: '.$app->start);
    //
    // }
    public function video_store(Request $request){
      $countvideo = video::where('medico_id',$request->medico_id)->count();
      if($countvideo >= 4){
        return response()->json('limite');
      }

        $request->validate([
          'name'=>'required',
          'link'=>'required'
        ]);

      $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
      $array = preg_match($patron, $request->link, $parte);

      if((int)$parte > 0) {
        $url = 'https://www.youtube.com/embed/'.$parte[1];
        $video = new video;
        $video->name =  $request->name;
        $video->link =  $url;
        $video->medico_id =  $request->medico_id;
        $video->save();
          return response()->json('ok');
        }else{
          return response()->json('invalida');
        }

    }

    public function medico_list_videos(Request $request){
      $videos = video::where('medico_id',$request->medico_id)->get();
      return view('medico.includes_perfil.list_videos')->with('videos',$videos);
    }

    public function delete_video(Request $request){
      $video = video::find($request->video_id);
      $video->delete();
      return response()->json('ok');
    }

    public function show_comentary(Request $request){
      $rate_medic = rate_medic::find($request->rate_id);
      $rate_medic->show = 'Si';
      $rate_medic->viewed = 'Si';
      $rate_medic->save();

      return response()->json('ok1');

    }
    public function hide_comentary(Request $request){
      $rate_medic = rate_medic::find($request->rate_id);
      $rate_medic->show = 'No';
      $rate_medic->viewed = 'Si';
      $rate_medic->save();

      $rate_medic_not_see_count = rate_medic::where('medico_id', $rate_medic->$medico_id)->whereNull('views')->count();
      $medico = medico::find($rate_medic->$medico_id);
      $medico->calification_not_see = $rate_medic_not_see_count;
      $medico->save();

      return response()->json('ok');

    }
    public function checked_comentary(Request $request){
      $rate_medic = rate_medic::find($request->rate_id);
      $rate_medic->viewed = 'Si';
      $rate_medic->save();

      $rate_medic_not_see_count = rate_medic::where('medico_id', $rate_medic->$medico_id)->whereNull('views')->count();
      $medico = medico::find($rate_medic->$medico_id);
      $medico->calification_not_see = $rate_medic_not_see_count;
      $medico->save();

      return response()->json('ok');

    }

    public function mark_all_see($id){
      $rate_medic = rate_medic::where('medico_id',$id)->where('viewed', 'No')->get();
      foreach ($rate_medic as $value) {
        $value->viewed ='Si';
        $value->save();

      }
      return back()->with('success', 'Se han marcado todas las nuevas Opiniones como vistas');
    }

    public function show_all_comentary_default($id){
      $medico = medico::find($id);
      $medico->show_comentary = 'Si';
      $medico->save();

      return Back()->with('success', 'Todas las opiniones entrantes de los usuarios, estaran configuradas para mostrar los comentarios de forma predeterminada');
    }

    public function hide_all_comentary_default($id){
      $medico = medico::find($id);
      $medico->show_comentary = 'No';
      $medico->save();

      return Back()->with('success', 'Todas las opiniones entrantes de los usuarios, estaran configuradas para ocultar los comentarios de forma predeterminada');
    }

    public function show_all_comentary_new($id){
      $rate_medic = rate_medic::where('medico_id',$id)->where('viewed','No')->get();

      foreach ($rate_medic as $value) {
        $value->show ='Si';
        $value->viewed ='Si';
        $value->save();
      }
      return back()->with('success','Todas las opiniones nuevas, se han configurado para mostrarse a los usuarios.');
    }

    public function hide_all_comentary_new($id){
      $rate_medic = rate_medic::where('medico_id',$id)->where('viewed','No')->get();

      foreach ($rate_medic as $value) {
        $value->show ='No';
        $value->viewed ='Si';
        $value->save();
      }

      return back()->with('success','Todas las opiniones nuevas, se han configurado para ocultarse a los usuarios.');

    }

    public function show_all_comentary($id){
      $rate_medic = rate_medic::where('medico_id',$id)->get();

      foreach ($rate_medic as $value) {
        $value->show ='Si';
        $value->viewed ='Si';
        $value->save();
      }

        return back()->with('success','Todas las opiniones registradas hasta la fecha, se configuraron para mostrarse.');
    }

    public function hide_all_comentary($id){
      $rate_medic = rate_medic::where('medico_id',$id)->get();

      foreach ($rate_medic as $value) {
        $value->show ='No';
        $value->viewed ='Si';
        $value->save();
      }
        return back()->with('warning','Todas las opiniones registradas hasta la fecha, se configuraron para ocultarse.');


    }

    public function income_medic($id){
      $list_citas_cobradas = event::where('medico_id',$id)->where('state', 'Pagada y Pendiente')->orWhere('state', 'Pagada y Completada')->whereNotNull('namePatient')->paginate(10);
      $list_citas_cobradas1 = event::where('medico_id',$id)->where('state', 'Pagada y Pendiente')->orWhere('state', 'Pagada y Completada')->whereNotNull('namePatient')->get();
      $ingresos_obtenidos = 0;
      foreach ($list_citas_cobradas1 as $value) {
        $ingresos_obtenidos = $ingresos_obtenidos + $value->price;
      }

      $citas_cobradas = event::where('medico_id',$id)->where('state', 'Pagada y Pendiente')->orWhere('state', 'Pagada y Completada')->whereNotNull('namePatient')->count();

      $list_citas_x_cobrar = event::where('medico_id',$id)->where('state', 'Pendiente')->whereNotNull('namePatient')->paginate(10);
      $list_citas_x_cobrar1 = event::where('medico_id',$id)->where('state', 'Pendiente')->whereNotNull('namePatient')->get();
      $ingresos_pendientes = 0;
      foreach ($list_citas_x_cobrar1 as $value) {
        $ingresos_pendientes =$ingresos_pendientes + $value->price;
      }

      $citas_pendientes = event::where('medico_id',$id)->where('state', 'Pendiente')->whereNotNull('namePatient')->count();

      return view('medico.income_medic.income_medic',compact('ingresos_obtenidos','citas_cobradas','ingresos_pendientes','citas_pendientes','list_citas_cobradas'));
    }

    public function income_medic_without_pay($id){
      $list_citas_cobradas = event::where('medico_id',$id)->where('state', 'Pagada y Pendiente')->orWhere('state', 'Pagada y Completada')->whereNotNull('namePatient')->paginate(10);
      $list_citas_cobradas1 = event::where('medico_id',$id)->where('state', 'Pagada y Pendiente')->orWhere('state', 'Pagada y Completada')->whereNotNull('namePatient')->get();
      $ingresos_obtenidos = 0;
      foreach ($list_citas_cobradas1 as $value) {
        $ingresos_obtenidos = $ingresos_obtenidos + $value->price;
      }
      $citas_cobradas = event::where('medico_id',$id)->where('state', 'Pagada y Pendiente')->orWhere('state', 'Pagada y Completada')->whereNotNull('namePatient')->count();

      $list_citas_x_cobrar = event::where('medico_id',$id)->where('state', 'Pendiente')->whereNotNull('namePatient')->paginate(10);
      $list_citas_x_cobrar1 = event::where('medico_id',$id)->where('state', 'Pendiente')->whereNotNull('namePatient')->get();
      $ingresos_pendientes = 0;
      foreach ($list_citas_x_cobrar1 as $value) {
        $ingresos_pendientes =$ingresos_pendientes + $value->price;
      }

      $citas_pendientes = event::where('medico_id',$id)->where('state', 'Pendiente')->whereNotNull('namePatient')->count();

      return view('medico.income_medic.income_medic_without_pay',compact('ingresos_obtenidos','citas_cobradas','ingresos_pendientes','citas_pendientes','list_citas_x_cobrar'));
    }

    public function check_show_rate(Request $request){
        $rate_medic = rate_medic::find($request->rate_id);
        if($rate_medic->show == 'si'){
            $rate_medic->show = Null;
        }else{
            $rate_medic->show = $request->valor;
        }
        $rate_medic->views = 'si';
        $rate_medic->save();

        $rate_medic_not_see_count = rate_medic::where('medico_id', $rate_medic->medico_id)->whereNull('views')->count();
        $medico = medico::find($rate_medic->medico_id);
        $medico->calification_not_see = $rate_medic_not_see_count;
        $medico->save();

        return response()->json('ok');

    }

    public function check_view_ajax(Request $request){
        $rate_medic = rate_medic::find($request->rate_id);
        $view = $rate_medic->views;
        $rate_medic->views = 'si';
        $rate_medic->save();

        $rate_medic_not_see_count = rate_medic::where('medico_id', $rate_medic->medico_id)->whereNull('views')->count();
        $medico = medico::find($rate_medic->medico_id);
        $medico->calification_not_see = $rate_medic_not_see_count;
        $medico->save();
        return response()->json('ok');
    }

    public function check_all_view($id){
        // dd('sdsd');
        $rate_medic = rate_medic::where('medico_id',$id)->get();

        foreach ($rate_medic as $value) {
            $value->views = 'si';
            $value->save();
        }
        $medico = medico::find($id);
        $medico->calification_not_see = 0;
        $medico->save();

        return back()->with('success', 'Todos los comentarios nuevos han sido marcados como vistos');
    }
    public function check_all_view_show($id){
        $rate_medic = rate_medic::where('medico_id',$id)->get();

        foreach ($rate_medic as $value) {
            $value->views = 'si';
            $value->show = 'si';
            $value->save();
        }

        $medico = medico::find($id);
        $medico->calification_not_see = 0;
        $medico->save();
        return back()->with('success', 'Todos los comentarios nuevos han sido marcados como vistos y configurados para mostrarse a los visitantes');
    }


}
