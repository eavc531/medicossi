<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\promoter;
use App\User;
use App\Role;
use App\medicalCenter;
use App\medico;
use App\specialty;
use App\country;
use Mail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class promotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function panel_control_promoters($id)
     {
        $promoter = promoter::find($id);

         return view('promoters.panel_control',compact('promoter'));
     }

     public function add_medical_center($id)
     {

        $countries = country::orderBy('name','asc')->pluck('name','name');

         return view('promoters.add_medical_center',compact('countries'));
     }

     public function list_medical_center_invited($id){
       $medicalCenters = medicalCenter::where('id_promoter',$id)->paginate(10);
       return view('promoters.medical_center_invited',compact('medicalCenters'));
     }

     public function list_client(Request $request,$id){

        $medicos = medico::where('promoter_id',$id)->get();
        $medicalCenters = medicalCenter::where('promoter_id',$id)->get();
        $client = $medicos->merge($medicalCenters);

       $col = new Collection($client);
       $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 2;
       $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $client = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
       $client->setPath(route('list_client',$id));



       return view('promoters.list_client',compact('client'));
     }

     public function list_client_activated(Request $request,$id){
       $medicos = medico::where('promoter_id',$id)->where('stateAccount', 'Activa')->get();

       $medicalCenters = medicalCenter::where('promoter_id',$id)->where('stateAccount', 'Activa')->get();
       $client = $medicos->merge($medicalCenters);

       $col = new Collection($client);
       $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 2;
       $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $client = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
       $client->setPath(route('list_client',$id));

        return view('promoters.list_client',compact('client'))->with('activated', 'value');
     }

     public function list_client_desactivated(Request $request,$id){

       $medicos = medico::where('promoter_id',$id)->where('stateAccount', 'Desactivada')->get();

       $medicalCenters = medicalCenter::where('promoter_id',$id)->where('stateAccount', 'Desactivada')->get();
       $client = $medicos->merge($medicalCenters);

       $col = new Collection($client);
       $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $perPage = 2;
       $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
       $client = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
       $client->setPath(route('list_client',$id));

        return view('promoters.list_client',compact('client'))->with('desactivated', 'value');
     }



     // public function list_medic_invited($id){
     //   $medicos = medico::where('id_promoter',$id)->paginate(10);
     //
     //   return view('promoters.list_medic_invited',compact('medicos'));
     // }
     public function store_medical_center(Request $request)
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
         $medicalCenter->promoter_id = $request->promoter_id;
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
         $promoter = promoter::find($request->promoter_id);

         $user->attachRole($role);
         Mail::send('mails.confirmMedicalCenter',['medicalCenter'=>$medicalCenter,'code'=>$code,'promoter'=>$promoter], function($msj) use ($medicalCenter){
            $msj->subject('Médicos Si');
            //$msj->to('eavc53189@gmail.com');
            $msj->to($medicalCenter->emailAdmin);

          });

         return redirect()->route('list_client',$request->promoter_id)->with('success', 'Se ha Registrado un nuevo usuario como su Invitado, solo falta que el usuario confirme su cuenta a travez de el correo asociado a su registro en el sistema.');

     }

     public function add_medic()
     {
       $countries = country::orderBy('name','asc')->pluck('name','name');
       $specialties = specialty::orderBy('name','asc')->pluck('name','name');

       return view('promoters.add_medic',compact('countries','specialties'));
     }

     public function store_medic(Request $request)
     {
       // dd($request->all());
         $request->validate([
            //'identification'=>'required|unique:medicos',
            'name'=>'required',
            'lastName'=>'required',
            'gender'=>'required',
            'specialty'=>'required',
            'country'=>'required',
            'email'=>'required|unique:medicos|unique:users',
            'password'=>'required',
            //'medicalCenter_id'=>'required',

            'phone'=>'required|numeric',
            //'facebook'=>'required',

         ]);

         if($request->terminos == Null){
           return back()->with('warning', 'Debes Aceptar los Términos y Condiciones, para poder continuar.')->withInput();
         }

         $medico = new medico;
         $medico->fill($request->all());
         $medico->stateConfirm = 'porConfirmar';
         $medico->promoter_id = $request->promoter_id;
         $medico->password = bcrypt($request->password);
         $medico->save();

         $code = str_random(25);
         $user = new User;
         $user->medico_id = $medico->id;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = bcrypt($request->password);
         $user->medico_id = $medico->id;
         $user->confirmation_code = $code;
         $user->role = 'medico';
         $user->save();

         $role = Role::where('name','medico')->first();

         $user->attachRole($role);
         $promoter = promoter::find($request->promoter_id);

         Mail::send('mails.confirmMedicoInvited',['medico'=>$medico,'user'=>$user,'code'=>$code,'promoter'=>$promoter],function($msj){
            $msj->subject('Médicos Si');
            $msj->to($medico->email);
       });

           return redirect()->route('list_client',$request->promoter_id)->with('success', 'Se ha Registrado un nuevo Médico como su invitado, solo falta que confirme su cuenta a travez de el correo asociado a su registro.');

     }

     public function clientsPromoter($id)
     {

       $promoter = promoter::find($id);

       $medicalCenters = medicalCenter::where('id_promoter',$promoter->id_promoter)->orderBy('name','asc')->paginate(10);

       $medicos = medico::where('id_promoter',$promoter->id_promoter)->orderBy('id','desc')->paginate(10);

         return view('promoters.clientsPromoter')->with('medicalCenters', $medicalCenters)->with('medicos', $medicos)->with('promoter', $promoter);
     }

    public function index()
    {

      $promoters = promoter::orderBy('id','desc')->paginate(10);
        return view('promoters.index')->with('promoters', $promoters);
    }

    public function citiesAdmin($id)
    {
        $citiesAll = city::orderBy('name','asc')->pluck('name','name');
        $cities = cities_admin::where('administrator_id',$id)->paginate(10);

        $administrator = administrator::find($id);

        return view('administrators.citiesAdmin')->with('cities', $cities)->with('citiesAll', $citiesAll)->with('administrator', $administrator);
    }

    public function deleteCityAdmin($id)
    {

        $cities_admin = cities_admin::find($id);

        $city1 = $cities_admin->name;
        cities_admin::destroy($id);

        return back()->with('danger', 'Se ha desabilitado la ciudad '.$city1.' para este Administrador');
    }

    public function citiesAdminStore(Request $request)
    {
      $request->validate([
        'name'=>'required|unique:cities_admins',

      ]);

        $cities_admin = new cities_admin;
        $cities_admin->name = $request->name;
        $cities_admin->administrator_id = $request->administrator_id;
        $cities_admin->save();

        $administrator = administrator::find($request->administrator_id);
        return back()->with('success', 'Se a asigando una nueva ciudad al Administrador: '.$administrator->name.' '.$administrator->lastName);
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promoters.create');
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
           'id_promoter'=>'required|unique:promoters',
           'name'=>'required',
           'lastName'=>'required',
           'email'=>'required|unique:promoters|unique:users',
           'password'=>'required',
        ]);

        $promoter = new promoter;
        $promoter->fill($request->all());
        $promoter->save();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->promoter_id = $promoter->id;
        $user->role = "Promotor";
        $user->save();
        // $role = Role::where('name','Admin')->first();

        //$user->attachRole($role);
         return redirect()->route('promoters.index')->with('success', 'Se ha agregado un nuevo promotor de forma Satisfactoria');

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
      $medico = medico::find($id);
        return view('medico.edit')->with('medico', $medico);
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
    public function destroy($id)
    {
        //
    }
}
