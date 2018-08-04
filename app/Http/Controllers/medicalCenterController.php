<?php

namespace App\Http\Controllers;
use App\country;
use App\User;
use Illuminate\Http\Request;
use App\medicalCenter;
use Mail;
use App\promoter;
use App\state;
use App\city;
use App\Role;
use App\day;
use App\medico;
use App\medical_center_specialty;
use App\Http\Controllers\HomeController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Geocoder;
use App\insurrance_show;
use App\insurance_carrier;
use App\medical_center_experience;
use App\photo;
use App\social_network;

use Illuminate\Validation\Rule;
class medicalCenterController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function __construct(){
    // $this->Middleware('medicalCenterConfirm',['only'=>['edit']]);

  }

  public function select_insurrances(Request $request){

    $medicalCenter = medicalCenter::find($request->medicalCenter_id);
    $medicalCenter->type_patient_service = $request->type_patient_service;
    $medicalCenter->save();

    return response()->json($request->all());

  }

  public function medical_center_experience_store(Request $request,$id){
    $request->validate([
      'name'=>['required', Rule::unique('medical_center_experiences')->where('medicalCenter_id',$id)],
    ]);

    $medical_center_experience = new medical_center_experience;
    $medical_center_experience->name = $request->name;
    $medical_center_experience->medicalCenter_id = $id;
    $medical_center_experience->save();
    return response()->json('ok');

  }

  public function medicalCenter_list_experience($id){
    $experiences =  medical_center_experience::where('medicalCenter_id',$id)->get();

    return view('medicalCenter.view_AJAX.experience_list')->with('experiences', $experiences);
  }

  public function medicalCenter_list_specialty($id){
    $specialties =  medical_center_specialty::where('medicalCenter_id',$id)->get();

    return view('medicalCenter.view_AJAX.specialty_list')->with('specialties', $specialties);
  }

  public function medical_center_specialty_store(Request $request,$id){
    $request->validate([
      'name'=>['required', Rule::unique('medical_center_specialties')->where('medicalCenter_id',$id)],

    ]);


    $medical_center_specialty = new medical_center_specialty;
    $medical_center_specialty->name = $request->name;
    $medical_center_specialty->medicalCenter_id = $id;
    $medical_center_specialty->save();

    return response()->json('ok');
  }

    public function create_add_insurrances(Request $request,$id){
      $insurrance_show = insurrance_show::orderBy('name','asc')->get();
      $insurances = insurance_carrier::where('medical_center_id',$id)->get();
      return view('medicalCenter.create_add_insurrances')->with('insurrance_show', $insurrance_show)->with('insurances', $insurances);
    }

    public function medicalCenter_store_insurrances(Request $request,$id){
      $request->validate([
        'name'=>'required|'.Rule::unique('insurance_carriers')->where('medical_center_id',$id)
      ]);

      $insurance = new insurance_carrier;
      $insurance->name = $request->name;
      $insurance->medical_center_id = $id;
      $insurance->save();

      return back()->with('success', 'Aseguradora agregada con exito');
    }

    public function medical_center_add_medico(Request $request){
      //$medicalCenter = medicalCenter::find($request->medicalCenter_id);
      $medico = medico::find($request->medico_id);
      //$medico->latitud = $medicalCenter->latitud;
      //$medico->longitud = $medicalCenter->longitud;
      $medico->medicalCenter_id = $request->medicalCenter_id;
      $medico->save();

      return redirect()->route('medical_center_manage_medicos',$request->medicalCenter_id)->with('success', 'El medico: '.$medico->name.' '.$medico->lastName.' ha sido agregado a este Centro Médico de forma Exitosa');
    }

    public function search_medico_belong_medical_center(Request $request,$id){


    $medicos = medico::where('name','LIKE','%'.$request->search.'%')
    ->orWhere('lastName','LIKE','%'.$request->search.'%')
    ->orWhere('identification','LIKE','%'.$request->search.'%')->get();
    // $medicosSearchCount = medico::where('name','LIKE','%'.$request->search.'%')
    // ->orWhere('lastName','LIKE','%'.$request->search.'%')
    // ->orWhere('identification','LIKE','%'.$request->search.'%')->count();

    $data = [];
      foreach ($medicos as $medico) {
        if($medico->medicalCenter_id == $id){
          $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'city'=>$medico->city,'email'=>$medico->email,'phone'=>$medico->phone];
        }

      }
    //dd($data);
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection($data);
      $perPage = 4;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $medicos = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
      $medicos->setPath(route('search_medico_medical_center',$id));

    return view('medicalCenter.medical_center_manage_medicos')->with('medicos', $medicos);
  }

    public function search_medico_medical_center(Request $request,$id){

    $medicos = medico::where('medicalCenter_id', $id)->get();
    $medicosSearch = medico::where('name','LIKE','%'.$request->search.'%')
    ->orWhere('lastName','LIKE','%'.$request->search.'%')
    ->orWhere('identification','LIKE','%'.$request->search.'%')->get();
    // $medicosSearchCount = medico::where('name','LIKE','%'.$request->search.'%')
    // ->orWhere('lastName','LIKE','%'.$request->search.'%')
    // ->orWhere('identification','LIKE','%'.$request->search.'%')->count();

    $data = [];
      foreach ($medicosSearch as $medico) {
        if($medico->medicalCenter_id == Null){
          $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'city'=>$medico->city,'email'=>$medico->email,'phone'=>$medico->phone];
        }

      }
    //dd($data);
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection($data);
      $perPage = 4;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $medicosSearch = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
      $medicosSearch->setPath(route('search_medico_medical_center',$id));
      $medicosSearchCount = $medicosSearch->count();

    return view('medicalCenter.medical_center_manage_medicos')->with('medicosSearch', $medicosSearch)->with('medicosSearchCount', $medicosSearchCount)->with('medicos', $medicos);
  }

  public function medical_center_manage_medicos($id){
    $medicos = medico::where('medicalCenter_id', $id)->orderBy('name','asc')->paginate(10);
    return view('medicalCenter.medical_center_manage_medicos')->with('medicos', $medicos);
  }

    public function medicalCenter_description_update(Request $request,$id){
      $request->validate([
        'description'=>'required|string|max:255'
      ]);
      $medicalCenter = medicalCenter::find($id);

      $medicalCenter->description = $request->description;
      $medicalCenter->save();
      return response()->json('ok');
    }

    public function medicalCenter_description_show($id){
      $medicalCenter = medicalCenter::find($id);
      return view('medicalCenter.view_AJAX.description_medicalCenter')->with('medicalCenter', $medicalCenter);
      //return response()->json($medicalCenter->description);
    }

  public function medical_center_edit_schedule($id){
    $medicalCenter = medicalCenter::find($id);
    $lunes = day::where('medical_center_id', $id)->where('name', 'lunes')->orderBy('hour_ini','asc')->get();
    $martes = day::where('medical_center_id', $id)->where('name', 'martes')->orderBy('hour_ini','asc')->get();
    $miercoles = day::where('medical_center_id', $id)->where('name', 'miercoles')->orderBy('hour_ini','asc')->get();
    $jueves = day::where('medical_center_id', $id)->where('name', 'jueves')->orderBy('hour_ini','asc')->get();
    $viernes = day::where('medical_center_id', $id)->where('name', 'viernes')->orderBy('hour_ini','asc')->get();
    $sabado = day::where('medical_center_id', $id)->where('name', 'sabado')->orderBy('hour_ini','asc')->get();
    $domingo = day::where('medical_center_id', $id)->where('name', 'domingo')->orderBy('hour_ini','asc')->get();

       return view('medicalCenter.edit_schedule')->with('medicalCenter', $medicalCenter)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo);
  }

  public function medical_center_schedule_delete($id){
    //day::destroy($id);

    $day = day::find($id);
    $day->delete();

    return back()->with('danger', 'se a eliminado horas de la columna: '.$day->name);
  }
  public function medical_center_store_schedule(Request $request,$id){
    //dd($request->all());

      $request->validate([
        'day'=>'required',
      ]);

      $medicalCenter = medicalCenter::find($id);
      $day = new day;
      $day->name = $request->day;
      $day->hour_ini = $request->hour_start.':'.$request->mins_start;
      $day->hour_end = $request->hour_end.':'.$request->mins_end;
      $day->medical_center_id = $id;
      $day->save();

      return back()->with('success', 'Se a han agregado nuevas horas al dia: '.$request->day);
  }

  public function medical_center_edit_address($id){
    $medicalCenter = medicalCenter::find($id);
    $cities = city::orderBy('name','asc')->pluck('name','name');
    $states = state::orderBy('name','asc')->pluck('name','name');
     return view('medicalCenter.edit_address')->with('medicalCenter', $medicalCenter)->with('cities', $cities)->with('states', $states);
  }

  public function medical_center_update_address(Request $request,$id){

      $request->validate([
        'country'=>'required',
        'state'=>'required',
        'city'=>'required',
        'postal_code'=>'required',
        'colony'=>'required',
        'street'=>'required',
        'number_ext'=>'required',
      ]);

        // $Coordinates =
        //  Geocoder::getCoordinatesForAddress($request->number_ext,$request->street,$request->colony,$request->city,$request->state,$request->country);


         $Coordinates = Geocoder::getCoordinatesForAddress($request->country.','.$request->city.','.$request->colony.','.$request->street.','.$request->number_ext);



        $medicalCenter = medicalCenter::find($id);
        $medicalCenter->country = $request->country;
        $medicalCenter->state = $request->state;
        $medicalCenter->city = $request->city;
        $medicalCenter->postal_code = $request->postal_code;
        $medicalCenter->colony = $request->colony;
        $medicalCenter->street = $request->street;
        $medicalCenter->number_ext = $request->number_ext;
        $medicalCenter->number_int = $request->number_int;
        $medicalCenter->longitud = $Coordinates['lng'];
        $medicalCenter->latitud = $Coordinates['lat'];
        $medicalCenter->save();


     return redirect()->route('medicalCenter.edit',$medicalCenter->id)->with('medicalCenter', $medicalCenter)->with('success','Se han actualziado datos de la Dirección del Centro Médico');
  }

  public function medical_center_edit_data($id){
    $medicalCenter = medicalCenter::find($id);
     return view('medicalCenter.medical_center_edit_data')->with('medicalCenter', $medicalCenter);
  }

  public function medical_center_edit_data_update(Request $request,$id){


    $request->validate([
      'name'=>'required',
      'nameAdmin'=>'required',
      //'email_institution'=>'required',
      'phone_admin'=>'required',
      'sanitary_license'=>'required',
      'id_medicalCenter'=>'required',
      //'phone'=>'required',
      //'phone2'=>'required',

    ]);

    $medicalCenter = medicalCenter::find($id);

    $medicalCenter->name = $request->name;
    $medicalCenter->nameAdmin = $request->nameAdmin;
    $medicalCenter->email_institution = $request->email_institution;
    $medicalCenter->phone_admin = $request->phone_admin;
    $medicalCenter->sanitary_license = $request->sanitary_license;
    $medicalCenter->id_medicalCenter = $request->id_medicalCenter;
    $medicalCenter->phone = $request->phone;
    $medicalCenter->phone2 = $request->phone2;

    $medicalCenter->save();

     return redirect()->route('medicalCenter.edit',$medicalCenter->id)->with('success','Se han guardado los datos del centro medico con exito');
  }


  public function medicalCenter_profile($id){
    $medicalCenter = medicalCenter::find($id);
     return view('medicalCenter.profile')->with('medicalCenter', $medicalCenter);
  }

  public function medical_center_panel($id){
    $medicalCenter = medicalCenter::find($id);
     return view('medicalCenter.panel.panel')->with('medicalCenter', $medicalCenter);
  }

  public function data_primordial_medical_center($id){

    $medicalCenter = medicalCenter::find($id);
     $countries = country::orderBy('name','asc')->pluck('name','name');
     //dd($countries);
     $cities = city::orderBy('name','asc')->pluck('name','name');
     $states = state::orderBy('name','asc')->pluck('name','name');
     return view('medicalCenter.data_primordial_medical_center')->with('medicalCenter', $medicalCenter)->with('cities', $cities)->with('states', $states)->with('countries',$countries);
  }

  public function data_primordial_medical_center2($id){

    $medicalCenter = medicalCenter::find($id);
    $countries = country::orderBy('name','asc')->pluck('name','name');
    //dd($countries);
    $cities = city::orderBy('name','asc')->pluck('name','name');
    $states = state::orderBy('name','asc')->pluck('name','name');
   return view('medicalCenter.data_primordial_medical_center_address')->with('medicalCenter', $medicalCenter)->with('cities', $cities)->with('states', $states)->with('countries',$countries);
  }

    public function confirmMedicalCenter($id,$code){
      $medicalCenter = medicalCenter::find($id);

      if($medicalCenter->confirmation_code == $code){
          $medicalCenter->confirmation_code = null;
          $medicalCenter->statuss = 'mailConfirmed';
          $medicalCenter->save();

          return redirect()->route('home')->with('confirmMedico', 'confirmMedico');
      }

         return redirect()->route('successRegMedicalCenter',$medicalCenter->id)->with('warning', 'No se pudo verificar la autenticacion del usuario, por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $countries = country::orderBy('name','asc')->pluck('name','name');

        return view('medicalCenter.create')->with('countries', $countries);
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
          'name'=>'required',
          'emailAdmin'=>'required|unique:medical_centers',
          'nameAdmin'=>'required',
          'phone_admin'=>'required|numeric',
          'password'=>'required',
          'country'=>'required',
        ]);

        if($request->terminos == Null){
          return back()->with('warning', 'Debes Aceptar los Términos y Condiciones, para poder continuar.')->withInput();
        }
        $code = str_random(25);
        $medicalCenter = new medicalCenter;
        $medicalCenter->fill($request->all());
        $medicalCenter->confirmation_code = $code;
        $medicalCenter->id_promoter = $request->id_promoter;
        $medicalCenter->save();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->emailAdmin;
        $user->password = bcrypt($request->password);
        $user->medical_center_id = $medicalCenter->id;
        $user->confirmation_code = $code;
        $user->role = 'medical_center';
        $user->save();

        $role = Role::where('name','medical_center')->first();

        $user->attachRole($role);
        Mail::send('mails.confirmMedicalCenter',['medicalCenter'=>$medicalCenter,'code'=>$code], function($msj) use ($medicalCenter){
           $msj->subject('Médicos Si');
           //$msj->to($medicalCenter->emailAdmin);
           $msj->to($medicalCenter->emailAdmin);

         });
         // if($request->id_promoter != Null){
         //   return redirect()->route('list_client',$request->id_promoter);
         // }
        return redirect()->route('successRegMedicalCenter',$medicalCenter->id);
    }

    public function successRegMedicalCenter($id){
      $medicalCenter = medicalCenter::find($id);
      return view('medicalCenter.successreg')->with('medicalCenter',$medicalCenter);
    }

    public function resend_mail_medical_center($id){
      $medicalCenter = medicalCenter::find($id);
      $code = str_random(25);
      $medicalCenter->confirmation_code = $code;
      $medicalCenter->save();
      Mail::send('mails.confirmMedicalCenter',['medicalCenter'=>$medicalCenter,'code'=>$code], function($msj) use ($medicalCenter){
         $msj->subject('Médicos Si');
         //$msj->to('eavc53189@gmail.com');
         $msj->to($medicalCenter->emailAdmin);
       });

       return redirect()->route('successRegMedicalCenter',$medicalCenter->id)->with('success','Se ha Enviado un mensaje a su correo electronico para que pueda Confirmar su Cuenta');
    }

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

      $images = photo::where('medicalCenter_id',$id)->get();

      $medicos = medico::where('medicalCenter_id', $id)->get();

      $insurance_carrier = insurance_carrier::where('medical_center_id',$id)->get();
      // /dd($medicos);

      $medicalCenter = medicalCenter::find($id);
      $lunes = day::where('medical_center_id', $id)->where('name', 'lunes')->orderBy('hour_ini','asc')->get();
      $martes = day::where('medical_center_id', $id)->where('name', 'martes')->orderBy('hour_ini','asc')->get();
      $miercoles = day::where('medical_center_id', $id)->where('name', 'miercoles')->orderBy('hour_ini','asc')->get();
      $jueves = day::where('medical_center_id', $id)->where('name', 'jueves')->orderBy('hour_ini','asc')->get();
      $viernes = day::where('medical_center_id', $id)->where('name', 'viernes')->orderBy('hour_ini','asc')->get();
      $sabado = day::where('medical_center_id', $id)->where('name', 'sabado')->orderBy('hour_ini','asc')->get();
      $domingo = day::where('medical_center_id', $id)->where('name', 'domingo')->orderBy('hour_ini','asc')->get();


      return view('medicalCenter.edit')->with('medicalCenter', $medicalCenter)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('medicos', $medicos)->with('images',$images)->with('insurance_carrier',$insurance_carrier);

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
      //dd($request->all());

        $medicalCenter = medicalCenter::find($id);

        if($medicalCenter->email_institution != $request->email_institution){
          $request->validate([
            'email_institution'=>'required|unique:medical_centers',
          ]);
        }


        $request->validate([
          'id_medicalCenter'=>'required',
          'name'=>'required',
          'nameAdmin'=>'required',
          //'email_institution'=>'required',
          'phone_admin'=>'required',
          'phone'=>'required',
          'city'=>'required',
          'country'=>'required',
          'sanitary_license'=>'required',
          'state'=>'required',
          'postal_code'=>'required',
          'colony'=>'required',
          'street'=>'required',
          'number_ext'=>'required',

        ]);

        if($request->city == 'opciones'){
          return back()->with('warning', 'El campo ciudad es requerido');
        }

        $medicalCenter = medicalCenter::find($id);
        $medicalCenter->fill($request->all());
        $medicalCenter->save();

        return redirect()->route('medicalCenter.edit',$id);

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

    public function delete_insurance(Request $request,$id)
    {
      $insurance_carrier = insurance_carrier::find($id);
      $name = $insurance_carrier->name;
      $insurance_carrier->delete();

      return back()->with('danger', 'La aseguradora: '.$name.' ha sido eliminada.');
    }
    public function medicalCenter_store_coordinates(Request $request,$id)
    {
      $medicalCenter = medicalCenter::find($id);
      $medicalCenter->longitud = $request->longitud;
      $medicalCenter->latitud = $request->latitud;
      $medicalCenter->save();

      return response()->json('ok');

    }

    public function medical_specialty_delete(Request $request){
      $specialties =  medical_center_specialty::find($request->id);
      $specialties->delete();
      return response()->json('ok');

    }

    public function medical_experience_delete(Request $request){
      $specialties =  medical_center_experience::find($request->id);
      $specialties->delete();
      return response()->json('ok');

    }

    public function medicalCenter_social_store(Request $request)
    {

        $request->validate([
          'name'=>'required|'.Rule::unique('social_networks')->where('medicalCenter_id',$request->medicalCenter_id),
          'link'=>'required'
        ]);

        $social_network = new social_network;
        $social_network->name = $request->name;
        $social_network->link = $request->link;
        $social_network->medicalCenter_id = $request->medicalCenter_id;
        $social_network->save();

        return response()->json('ok');
    }

    public function medicalCenter_social_list(Request $request){
        $social_networks = social_network::where('medicalCenter_id', $request->medicalCenter_id)->get();
        return view('medicalCenter.view_AJAX.list_social')->with('social_networks', $social_networks);
    }

}
