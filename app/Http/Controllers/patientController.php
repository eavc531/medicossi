<?php

namespace App\Http\Controllers;
use App\patient;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Mail;
use App\country;
use App\state;
use App\city;
use App\medico;
use App\patients_doctor;
use App\event;
use App\note;
use Geocoder;
use Carbon\Carbon;
use Auth;
use App\rate_medic;
use App\photo;
use App\data_patient;
use App\rate_and_comentary_medic;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
class patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // public function __construct()
     //  {
     //     $this->middleware('authenticate', ['except' => ['patient_register_view','patient_register']]);
     //  }
     public function __construct()
      {
         // $this->middleware('authenticate', ['except' => ['patient_register','successRegPatient','patient_register_view']]);
      }


     public function calification_medic_show_patient(Request $request){
         // return response()->json($request->all());
         $take = 2;
         if($request->has('skip')){
             $skip = $request->skip;
             $vista = 'show_more';

         }else {
             $skip = 0;
             $vista = 'normal';
         }

         $medico = medico::find($request->medico_id);

         $views = 'vistas';

         $rate_medic = rate_medic::where('medico_id',$request->medico_id)->where('views','si')->skip($skip)->take(2)->get();

         // return response()->json($rate_medic);


        if($request->has('skip')){
             return view('patient.medico.show_more_calification_ajax',compact('rate_medic','medico','views','skip'));
         }
             return view('patient.medico.calification_ajax',compact('rate_medic','medico','views','skip'));



     }



     public function qualify_medic($p_id,$m_id,$app_id){

         // return 'eje';
       $event = event::find($app_id);

       if($event->status == 'calificada'){
         return back()->with('success','Solo puedes calificar al Médico una vez por Cita.');
       }

       if(\Carbon\Carbon::now() > \Carbon\Carbon::parse($event->end)->format('Y-m-d H:i')){
         return back()->with('success','No puedes calificar la Cita hasta despues de su fecha de culminacion.');
       }

       $you_rate = rate_medic::where('patient_id',$p_id)->where('medico_id', $m_id)->first();

       $count_rate = rate_medic::where('patient_id', $p_id)->where('medico_id', $m_id)->count();

       $medico = medico::find($m_id);

       $patient = patient::find($p_id);

       return view('patient.rate_medic',compact('you_rate','medico','patient','count_rate','event'));

     }


     public function store_rate_comentary(Request $request)
     {
          $medico = medico::find($request->medico_id);


         $request->validate([
            'answer1'=>'required|max:255',
            'answer2'=>'required|max:255',
            'answer3'=>'required|max:255',
            'answer4'=>'required|max:255',
            'answer5'=>'max:255',
            'answer6'=>'max:255',
            'answer7'=>'max:255',
         ]);

        function valorar($value){
            if($value == 'Pésima'){
                return 1;
            }elseif ($value == 'Mala') {
                return 2;
            }elseif ($value == 'Regular') {
                return 3;
            }elseif ($value == 'Buena') {
                return 4;
            }elseif ($value == 'Excelente') {
                return 5;
            }
        }

        $puntaje1 = valorar($request->answer1);
        $puntaje2 = valorar($request->answer2);
        $puntaje3 = valorar($request->answer3);
        // dd($puntaje1);
        $valor_total = ($puntaje1 + $puntaje2 + $puntaje3)/3;
        // $valor_total = round($valor_total);

      $verifyrcm = rate_medic::where('medico_id', $request->medico_id)->where('patient_id', $request->patient_id)->first();
      // $rate_medicT = rate_medic::
      if($verifyrcm == Null){
          $rcm = new rate_medic;
          $rcm->fill($request->all());
          $rcm->rate = $valor_total;
          $rcm->patient_id = $request->patient_id;
          $rcm->save();

      }else{
          $verifyrcm->fill($request->all());
          $verifyrcm->rate = $valor_total;
           $verifyrcm->views = Null;
          $verifyrcm->renews = 'si';
          $verifyrcm->save();
      }

      $rate_medic_not_see_count = rate_medic::where('medico_id', $medico->id)->whereNull('views')->count();

      $rate_medic_count = rate_medic::where('medico_id',$medico->id)->count();
      $rate_medic_total = rate_medic::where('medico_id',$medico->id)->sum('rate');
      $medico->calification = $rate_medic_total/$rate_medic_count;
      $medico->votes = $rate_medic_count;
      $medico->calification_not_see = $rate_medic_not_see_count;
      $medico->save();

      $event = event::find($request->event_id);
      $event->status = 'calificada';

      $event->save();

      return  redirect()->route('patient_appointments',\Hashids::encode(Auth::user()->patient_id))->with('success', 'Se a guardado su opinion referente al Profesional Médico: '.$medico->nameComplete);

     }


     public function patient_rate_medic($p_id,$m_id){

       $you_rate = rate_medic::where('patient_id', $p_id)->first();
       $rate_medic = rate_medic::paginate(10);
       $medico = medico::find($m_id);
       $patient = medico::find($p_id);

       return view('patient.patient_rate_medic',compact('you_rate','rate_medic','medico','patient'));
     }


       public function patient_add_medic($id)
     {
       $p_m_count = patients_doctor::where('medico_id',$id)->where('patient_id',Auth::user()->patient->id)->count();
       $medico = medico::find($id);
       if($p_m_count == 0){
           if($p_m_count == 0){
               $patient = patient::find(Auth::user()->patient_id);
               $data_patient = new data_patient;
               $data_patient->fill($patient->toArray());
               $data_patient->medico_id = $id;
               $data_patient->patient_id = $patient->id;
               $data_patient->nameComplete = $patient->name.' '.$patient->lastName;
               $data_patient->save();

             $patients_doctors = new patients_doctor;
             $patients_doctors->patient_id = $patient->id;
             $patients_doctors->medico_id = $id;
             $patients_doctors->data_patient_id = $data_patient->id;
             $patients_doctors->save();
           }

         return back()->with('success', 'El médico: '.$medico->name.' '.$medico->lastName.' ha sido añadido a tu lista de Médicos.');
       }else{
          return back()->with('warning', 'El médico: '.$medico->name.' '.$medico->lastName.' ya fue agregado previamente a tu lista de Médicos.');
       }

     }
       public function resend_mail_confirm_patient($id)
     {
       $patient = patient::find($id);
       $user = user::where('patient_id',$id)->first();
       $code = str_random(25);

       $patient->confirmation_code = $code;
       $patient->save();

       Mail::send('mails.confirmPatient',['patient'=>$patient,'code'=>$code,'user'=>$user], function($msj) use ($patient){
          $msj->subject('Médicos Si');
          $msj->to($patient->email);
          // $msj->to('eavc53189@gmail.com');

        });

        return redirect()->route('successRegPatient',\Hashids::encode($patient->id))->with('success', 'Se ha reenviado el mensaje de confirmación, al correo electronico asociado a tu cuenta MédicosSi');

     }

     public function patient_profile($id)
     {
         $patient = patient::find($id);
         $photo = photo::where('patient_id',$id)->where('type', 'perfil')->first();

         return view('patient.profile')->with('patient', $patient)->with('photo', $photo);
     }

    public function index()
    {
        $patient = patient::orderBy('name','asc')->paginate(10);
        return view('patient.profile')->with('patients', $patient);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function patient_medicos($id)
     {

      $patient = patient::find($id);

      $medicos = patients_doctor::Join('medicos', 'patients_doctors.medico_id', '=', 'medicos.id')
                                  ->Join('patients', 'patients_doctors.patient_id', '=', 'patients.id')
                                  ->select('medicos.*','patients_doctors.id as patients_doctor_id')
                                  ->where('patients.id',$id)
                                  ->orderBy('patients_doctors.created_at','desc')
                                  ->get();
       $data = [];
      foreach ($medicos as $medico) {
              $photo = photo::where('medico_id',$medico->id)->where('type', 'perfil')->first();
              //dd($photo);
            if($photo == Null){
              $image = Null;
            }else{
              $image = $photo->path;
            }

            $data[$medico->id] = ['identification'=>$medico->identification,'specialty'=>$medico->specialty,'id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud,'image'=>$image,'patients_doctor_id'=>$medico->patients_doctor_id,'calification'=>$medico->calification,'votes'=>$medico->votes,'plan'=>$medico->plan];


      }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $medicos = patientController::paginate_custom($data,$currentPage);


         return view('patient.patient_medicos',compact('medicos','patient'));
     }

     public function paginate_custom($data,$currentPage){

       $col = new Collection($data);
       $perPage = 8;
       $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $medicosCerc = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
       $medicosCerc->setPath(route('tolist2'));
       return $medicosCerc;
     }



     public function rate_appointment($id)
     {
       $app = event::find($id);
       return view('patient.rate_appointment',compact('app'));
     }

     public function patient_appointments(Request $request,$id)
     {

         $appointments_pending_confirm_count = event::where('patient_id', $id)->where('state','Pendiente')->where('confirmed_medico','!=','Si')->orderBy('start','asc')->count();
       $patient = patient::find($id);
       $appointments = event::where('patient_id', $id)->orderBy('id','desc')->paginate(4);

         return view('patient.appointments',compact('patient','appointments','appointments_pending_confirm_count'));
     }

     public function patient_appointments_pending(Request $request,$id)
     {
          $appointments_pending_confirm_count = event::where('patient_id', $id)->where('state','Pendiente')->where('confirmed_medico','!=','Si')->orderBy('start','asc')->count();
           $patient = patient::find($id);
           // end = 2018-08-13 09:30:00
           // now = 2018-08-13 08:40:15
           $appointments = event::where('patient_id', $id)->where('confirmed_medico','=','Si')->where('state','!=', 'Rechazada/Cancelada')->where('end','>',\Carbon\Carbon::now())->orderBy('start','asc')->paginate(4);
       // dd($appointments);
       $pending = 'Pendiente';
         return view('patient.appointments',compact('patient','appointments','pending','appointments_pending_confirm_count'));
     }
     //verificar estoo
     public function patient_appointments_unrated(Request $request,$id)
     {
          $appointments_pending_confirm_count = event::where('patient_id', $id)->where('state','Pendiente')->where('confirmed_medico','!=','Si')->orderBy('start','asc')->count();

           $patient = patient::find($id);
           $appointments = event::where('patient_id', $id)->whereNull('status')->where('state','!=', 'Rechazada/Cancelada')->where('end','<',\Carbon\Carbon::now()->format('Y-m-d H:i'))->where('confirmed_medico', 'Si')->orderBy('id','desc')->paginate(4);

           // dd('sdsd');
            $unrated = 'Por Calificar';
             return view('patient.appointments',compact('patient','appointments','unrated','appointments_pending_confirm_count'));
     }

     public function patient_pending_confirm(Request $request,$id)
     {
          $appointments_pending_confirm_count = event::where('patient_id', $id)->where('state','!=','Rechazada/Cancelada')->where('state','!=','Rechazada/Cancelada')->where('confirmed_medico','!=','Si')->orderBy('start','asc')->count();

           $patient = patient::find($id);
           // end = 2018-08-13 09:30:00
           // now = 2018-08-13 08:40:15
           $appointments = event::where('patient_id', $id)->where('state','Pendiente')->where('confirmed_medico','!=','Si')->orderBy('start','asc')->paginate(4);

           // dd($appointments);
           $pending_confirm = 'Pendiente';
             return view('patient.appointments',compact('patient','appointments','pending_confirm','appointments_pending_confirm_count'));
     }

    public function create()
    {
        return view('patient.create');
    }

    public function patient_edit_data($id)
    {
      $patient = patient::find($id);
        return view('patient.patient_edit_data')->with('patient', $patient);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function patient_register_view(Request $request){
       return view('patient.patient_register');
     }

     public function patient_register(Request $request){


       $age =  \Carbon\Carbon::parse($request->birthdate)->diffInYears(\Carbon\Carbon::now());

       $request->validate([
         'identification'=>'required|unique:patients',
         'gender'=>'required',
         'name'=>'required',
         'lastName'=>'required',
         'phone1'=>'required|numeric',
         'birthdate'=>'required',
         'email'=>'required|email|unique:patients|unique:users',
         'password'=>'required',
       ]);

       $code = str_random(25);
       $patient = new patient;
       $patient->fill($request->all());
       $patient->age = $age;
       $patient->nameComplete = $patient->name." ".$patient->lastName;
       // $patient->birthdate =
       $patient->confirmation_code = $code;
       $patient->save();
       $user = new User;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->patient_id = $patient->id;

       $user->role = 'Paciente';
       $user->save();
       $role = Role::where('name','patient')->first();

       $user->attachRole($role);
       // dd($patient->email);
       Mail::send('mails.confirmPatient',['patient'=>$patient,'code'=>$code,'user'=>$user], function($msj) use ($patient){
          $msj->subject('Médicos Si');
          $msj->subject($patient->email);
          // $msj->to('eavc53189@gmail.com');

        });

        return redirect()->route('successRegPatient',\Hashids::encode($patient->id));
     }

     public function successRegPatient($id)
     {
       $patient = patient::find($id);
       $user = User::where('medico_id',$id)->get();

         return view('patient.successReg')->with('user', $user)->with('patient', $patient);
     }

     public function confirmPatient($id,$code){

         $patient = patient::find($id);
         if($patient->confirmation_code == $code){
             $patient->confirmation_code = Null;
             $patient->stateConfirm = 'mailConfirmed';
             $patient->save();

             return redirect()->route('home')->with('confirmMedico', 'confirmMedico');
     }else{
       $patient->save();
        return redirect()->route('successRegPatient',\Hashids::encode($patient->id))->with('warning', 'No se pudo verificar la autenticacion del usuario,por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');
     }
   }

    // public function store(Request $request)
    // {
    //   $request->validate([
    //     'identification'=>'required|unique:patients',
    //     'gender'=>'required',
    //     'name'=>'required',
    //     'lastName'=>'required',
    //     'phone1'=>'required|numeric',
    //     'phone2'=>'numeric|nullable',
    //     'email'=>'required|email|unique:patients',
    //     'password'=>'required',
    //   ]);
    //
    //   $patient = new patient;
    //   $patient->fill($request->all());
    //   $patient->nameComplete = $request->name.' '.$request->lastName;
    //   $patient->save();
    //
    //   $user = new User;
    //   $user->name = $request->name;
    //   $user->email = $request->email;
    //   $user->password = bcrypt($request->password);
    //   $user->patient_id = $patient->id;
    //   $user->role = 'Paciente';
    //
    //   $user->save();
    //   $role = Role::where('name','patient')->first();
    //
    //   $user->attachRole($role);
    //    return redirect()->route('patient.index')->with('success', 'Se ha registrado un nuevo Paciente de Forma Satisfactoria');
    // }

    public function edit($id)
    {
      $patient = patient::find($id);
        return view('patient.edit')->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patient_update(Request $request, $id)
    {

        $request->validate([
          'identification'=>'required',
          'gender'=>'required',
          'name'=>'required',
          'lastName'=>'required',
          'name'=>'required',
          'lastName'=>'required',
          'birthdate'=>'required',
          'phone1'=>'required|numeric',

        ]);

      $user = User::where('patient_id',$id)->first();
      $patient = patient::find($id);
      $name = $patient->name.' '.$patient->lastName;


      if($request->identification != $patient->identification){
        $request->validate([
        'identification'=>'unique:patients',
        ]);

      }
      $age =  \Carbon\Carbon::parse($request->birthdate)->diffInYears(\Carbon\Carbon::now());
        $patient->fill($request->all(),['except'=>['email']]);
        $patient->nameComplete = $request->name.' '.$request->lastName;
        $patient->age = $age;
        $patient->save();
        $user->name = $request->name;

        $user->save();


        return redirect()->route('patient_profile',\Hashids::encode($id))->with('success', 'Los datos han sido actualizados de forma exitosa.');
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

    public function delete_patient_doctors($id)
    {
        $pd = patients_doctor::find($id);
        $medico = medico::find($pd->medico_id);
        $pd->delete();

        return back()->with('danger', 'El Médico: '.$medico->name.' '.$medico->lastName.' ha sido Eliminado de tu lista de Médicos');
    }

    public function address_patient($id){
      $patient = patient::find($id);
      $countries = country::orderBy('name','asc')->pluck('name','name');
      $states = state::orderBy('name','asc')->pluck('name','name');
      $cities = city::orderBy('name','asc')->pluck('name','name');

      return view('patient.edit_address',compact('countries','states','cities','patient'));
    }

    public function patient_store_address(Request $request,$id){

        $request->validate([
          'country'=>'required',
          'state'=>'required',
          'city'=>'required',
          'postal_code'=>'required',
          'colony'=>'required',
          'street'=>'required',
          // 'number_ext'=>'required',
        ]);

         if($request->city == 'opciones'){
           return back()->with('warning', 'El campo ciudad es requerido')->withInput();
         }

           $Coordinates = Geocoder::getCoordinatesForAddress($request->country.','.$request->city.','.$request->colony.','.$request->street.','.$request->number_ext);



          $patient = patient::find($id);
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

          if($patient->stateConfirm != 'complete'){
            $patient->stateConfirm = 'complete';
            $patient->save();
            return redirect()->route('home')->with('success', '!Bienvendi@¡ los datos de su dirección han sido guardados con exito');
          }

          $patient->save();

          return redirect()->route('patient_profile',\Hashids::encode($patient->id))->with('success', 'Datos de dirección guardados de forma satisfactoria');
    }

    public function stipulate_appointment($id){
      $medico = medico::find($id);

      return view('patient.stipulate_appointment',compact('medico'));
    }


}
