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
use App\records_of_plans_medico;
use Mail;
use Session;
use App\account_number;
use Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
class promotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function deposit_details($id)
     {
         $record = records_of_plans_medico::find($id);
         // $account_numbers = account_number::where('promoter_id', 1)->get();
         // dd($account_numbers);
         return view('promoters.deposit_details',compact('record'));

     }
     public function deposit_establish_payment_store(Request $request)
     {
         $request->validate([
             'name_banco'=>'required',
             'number_account'=>'required',
            'name_titular'=>'required',
            'identification'=>'required',
            'email'=>'nullable',
         ]);

        $record = records_of_plans_medico::find($request->record_id);
        $record->name_banco  =$request->name_banco;
        $record->number_account = $request->number_account;
        $record->name_titular = $request->name_titular;
        $record->identification = $request->identification;
        $record->email = $request->email;
        $record->state_payment = 'si';
        $record->date_payment = $request->date_payment;
        $record->save();

        return redirect()->route('promoter_deposits',$record->promoter_id)->with('success', 'se ha marcado el deposito como pagado, de forma satisfactoria.');

     }

     public function deposit_establish_payment($id)
     {
         $record = records_of_plans_medico::find($id);
         $account_numbers = account_number::where('promoter_id', $record->promoter_id)->get();
         // dd($account_numbers);
         return view('promoters.deposit_establish_payment',compact('record','account_numbers'));

     }

     public function account_number_update(Request $request)
     {
         $request->validate([
             'name_banco'=>'required',
             'number_account'=>'required',
            'name_titular'=>'required',
            'identification'=>'required',
            'email'=>'nullable',
         ]);


         $a_n = account_number::find($request->account_id);
         $a_n->name_banco = $request->name_banco;
         $a_n->number_account = $request->number_account;
        $a_n->name_titular = $request->name_titular;
        $a_n->identification = $request->identification;
        $a_n->email = $request->email;

        $a_n->save();

        return redirect()->route('accounts_number',$a_n->promoter_id)->with('success', 'cambios guardados de forma satisfactoria');
    }


    public function account_number_delete($id)
    {
        $account = account_number::find($id);
        $promoter_id = $account->promoter_id;
        $account->delete();

        return redirect()->route('accounts_number',$promoter_id)->with('danger', 'Se ha eliminado el numero de cuenta de forma satisfactoria');

    }
     public function account_number_edit($id)
     {
         $account = account_number::find($id);
         return view('promoters.account_number_edit',compact('account'));

     }

     public function account_number_store(Request $request){
         // dd($request->all());
         $validator = Validator::make($request->all(), [
           'name_banco'=>'required',
           'number_account'=>'required',
          'name_titular'=>'required',
          'identification'=>'required',
          'email'=>'nullable',
         ]);

         if ($validator->fails()) {
              return back()->with('error_form', 'value')
                           ->withErrors($validator)
                           ->withInput();
          }

          $a_n = new account_number;
          $a_n->name_banco = $request->name_banco;
          $a_n->number_account = $request->number_account;
         $a_n->name_titular = $request->name_titular;
         $a_n->identification = $request->identification;
         $a_n->email = $request->email;
         $a_n->promoter_id = $request->promoter_id;
         $a_n->save();

         return back()->with('success', 'se a agregado el numero de cuenta de forma satisfactoria');
     }

     public function accounts_number($id){
         $account_numbers = account_number::where('promoter_id',$id)->paginate(10);
         $promoter = promoter::find($id);

         return view('promoters.account_numbers',compact('account_numbers','promoter'));
     }

     public function promoter_deposits_pending($id){

         $comisions_paid_out = records_of_plans_medico::where('promoter_id',$id)->where('state_payment', 'si')->sum('comision');
         $comisions_pending = records_of_plans_medico::where('promoter_id',$id)->where('state_payment', 'no')->sum('comision');

        $record_plans = records_of_plans_medico::where('promoter_id',$id)->whereNotNull('comision')->where('comision','!=',0)->where('state_payment','no')->paginate(10);
        $promoter = promoter::find($id);

       $total_comisiones = records_of_plans_medico::where('promoter_id',$id)->whereNotNull('comision')->where('comision','!=',0)->sum('comision');
       $pendientes = 'sdsd';

       return view('promoters.deposits',compact('record_plans','total_comisiones','pendientes','promoter','comisions_paid_out','comisions_pending'));
     }

     public function promoter_deposits_paid_out($id){
         $comisions_paid_out = records_of_plans_medico::where('promoter_id',$id)->where('state_payment', 'si')->sum('comision');
         $comisions_pending = records_of_plans_medico::where('promoter_id',$id)->where('state_payment', 'no')->sum('comision');
        $record_plans = records_of_plans_medico::where('promoter_id',$id)->whereNotNull('comision')->where('comision','!=',0)->where('state_payment','si')->paginate(10);
        $promoter = promoter::find($id);
       $total_comisiones = records_of_plans_medico::where('promoter_id',$id)->whereNotNull('comision')->where('comision','!=',0)->sum('comision');

       $realizados = 'sdssd';
       return view('promoters.deposits',compact('record_plans','total_comisiones','realizados','promoter','comisions_paid_out','comisions_pending'));
     }

     public function promoter_deposits($id){
         $promoter = promoter::find($id);

        $record_plans = records_of_plans_medico::where('promoter_id',$id)->whereNotNull('comision')->where('comision','!=',0)->paginate(10);
        $comisions_paid_out = records_of_plans_medico::where('promoter_id',$id)->where('state_payment', 'si')->sum('comision');
        $comisions_pending = records_of_plans_medico::where('promoter_id',$id)->where('state_payment', 'no')->sum('comision');

       $total_comisiones = records_of_plans_medico::where('promoter_id',$id)->whereNotNull('comision')->where('comision','!=',0)->sum('comision');



       return view('promoters.deposits',compact('record_plans','total_comisiones','promoter','comisions_paid_out','comisions_pending'));
     }


     public function promoter_medico_comisions($id)
     {

        $record_plans = records_of_plans_medico::where('medico_id',$id)->paginate(10);
        $medico = medico::find($id);

        $back = redirect()->getUrlGenerator()->previous();
        Session::flash('back',$back);

         return view('promoters.medico_comisions',compact('record_plans','medico'));
     }

     public function panel_control_promoters($id)
     {

        $promoter = promoter::find($id);
        $activaciones = medico::where('promoter_id', $id)->count();

        $activaciones_mes = medico::where('promoter_id', $id)->count();

        $month = \carbon\carbon::now()->endOfDay();

        $start_month = $month->startOfMonth()->format('Y-m-d H:i:s');
        $end_month = $month->endOfMonth()->format('Y-m-d H:i:s');

          $activaciones_mes = DB::table('medicos')
            ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
            ->select('records_of_plans_medicos.*')
            ->where('records_of_plans_medicos.promoter_id', $id)
             ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)
            ->count();

              $comisions_recibidas = DB::table('medicos')
                ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                ->select('records_of_plans_medicos.*')
                ->where('records_of_plans_medicos.promoter_id', $id)
                 ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)->where('state_payment', 'si')
                ->sum('comision');

                $comisions_pendientes = DB::table('medicos')
                  ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                  ->select('records_of_plans_medicos.*')
                  ->where('records_of_plans_medicos.promoter_id', $id)
                   ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)->where('state_payment','!=','si')
                  ->sum('comision');

                  $prospectos_visitados = medico::where('promoter_id',$id)->where('created_at','>',$start_month)->where('created_at','<', $end_month)->count();

                  $comisions_total = DB::table('medicos')
                    ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                    ->select('records_of_plans_medicos.*')
                    ->where('records_of_plans_medicos.promoter_id', $id)
                    ->sum('comision');

                    $comisions_totales_recibidas = DB::table('medicos')
                      ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                      ->select('records_of_plans_medicos.*')
                      ->where('records_of_plans_medicos.promoter_id', $id)
                      ->where('state_payment','si')
                      ->sum('comision');

                      $comisions_totales_pendientes = DB::table('medicos')
                        ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                        ->select('records_of_plans_medicos.*')
                        ->where('records_of_plans_medicos.promoter_id', $id)
                        ->where('state_payment','!=','si')
                        ->sum('comision');

                        $prospectos_visitados_totales = medico::where('promoter_id',$id)->count();

                    //MEDICOS Y Especialistas
                    $plan_mi_agenda_spcialties = medico::where('promoter_id', $id)
                                            ->where('Plan','plan_agenda')
                                            ->where('specialty_category','Medicos y Especialistas')
                                            ->count();

                    $plan_profesional_spcialties = medico::where('promoter_id', $id)
                                            ->where('Plan','plan_profesional')
                                            ->where('specialty_category','Medicos y Especialistas')
                                            ->count();
                    $plan_platino_spcialties = medico::where('promoter_id', $id)
                                            ->where('Plan','plan_platino')
                                            ->where('specialty_category','Medicos y Especialistas')
                                            ->count();


                    $plan_mi_agenda = medico::where('promoter_id', $id)
                                            ->where('Plan','plan_agenda')
                                            ->where('specialty_category','!=','Medicos y Especialistas')
                                            ->count();

                    $plan_profesional = medico::where('promoter_id', $id)
                                            ->where('Plan','plan_profesional')
                                            ->where('specialty_category','!=','Medicos y Especialistas')
                                            ->count();
                    $plan_platino = medico::where('promoter_id', $id)
                                            ->where('Plan','plan_platino')
                                            ->where('specialty_category','!=','Medicos y Especialistas')
                                            ->count();
                    //DATOS GRAFICAS
                    function day($var){
                        if($var == '01'){
                            return 'Enero';
                        }elseif ($var == '02') {
                            return 'Febrero';
                        }elseif ($var == '03') {
                            return 'Marzo';
                        }elseif ($var == '04') {
                            return 'Abril';
                        }elseif ($var == '05') {
                            return 'Mayo';
                        }elseif ($var == '06') {
                            return 'Junio';
                        }elseif ($var == '07') {
                            return 'Julio';
                        }elseif ($var == '08') {
                            return 'Agosto';
                        }elseif ($var == '09') {
                            return 'Septiembre';
                        }elseif ($var == '10') {
                            return 'Octubre';
                        }elseif ($var == '11') {
                            return 'Noviembre';
                        }else{
                            return 'Diciembre';
                            }
                    }

                    function calculate_comision($id,$start_month,$end_month){
                        $mes =  DB::table('medicos')
                           ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                           ->select('records_of_plans_medicos.*')
                           ->where('records_of_plans_medicos.promoter_id', $id)
                          ->where('records_of_plans_medicos.created_at','>',$start_month)
                          ->where('records_of_plans_medicos.created_at','<',$end_month)
                          ->where('state_payment','=','si')
                          ->sum('comision');

                         return $mes;
                    }

                    function calculate_comision_total($id,$start_month,$end_month){
                        $mes =  DB::table('medicos')
                           ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                           ->select('records_of_plans_medicos.*')
                           ->where('records_of_plans_medicos.promoter_id', $id)
                          ->where('records_of_plans_medicos.created_at','>',$start_month)
                          ->where('records_of_plans_medicos.created_at','<',$end_month)
                          // ->where('state_payment','=','si')
                          ->sum('comision');

                         return $mes;
                    }
                    // GRAFICAS
                    //


                    $fecha_actual = \Carbon\Carbon::now();

                    $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                    $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                    $name_mes6 = day($fecha_actual->format('m'));

                     $mes6 = calculate_comision($id,$start_month,$end_month);
                     $mes_t_6 = calculate_comision_total($id,$start_month,$end_month);

                       $fecha_actual = \Carbon\Carbon::now()->subMonth();

                       $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                       $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                       $name_mes5 = day($fecha_actual->format('m'));
                        $mes5 = calculate_comision($id,$start_month,$end_month);
                        $mes_t_5 = calculate_comision_total($id,$start_month,$end_month);



                        $fecha_actual = \Carbon\Carbon::now()->subMonths(2);

                        $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                        $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                        $name_mes4 = day($fecha_actual->format('m'));
                         $mes4 = calculate_comision($id,$start_month,$end_month);
                         $mes_t_4 = calculate_comision_total($id,$start_month,$end_month);


                         $fecha_actual = \Carbon\Carbon::now()->subMonths(3);

                         $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                         $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                         $name_mes3 = day($fecha_actual->format('m'));
                         $mes3 = calculate_comision($id,$start_month,$end_month);
                         $mes_t_3 = calculate_comision_total($id,$start_month,$end_month);

                          $fecha_actual = \Carbon\Carbon::now()->subMonths(4);

                          $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                          $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                          $name_mes2 = day($fecha_actual->format('m'));
                           $mes2 = calculate_comision($id,$start_month,$end_month);
                           $mes_t_2 = calculate_comision_total($id,$start_month,$end_month);

                           $fecha_actual = \Carbon\Carbon::now()->subMonths(5);

                           $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                           $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                           $name_mes1 = day($fecha_actual->format('m'));

                           $mes1 = calculate_comision($id,$start_month,$end_month);
                           $mes_t_1 = calculate_comision_total($id,$start_month,$end_month);


                            $ingresosgrafica = ['mes1'=>['comision'=>$mes1,'name'=>$name_mes1,'comision_t'=>$mes_t_1],'mes2'=>['comision'=>$mes2,'name'=>$name_mes2,'comision_t'=>$mes_t_2],'mes3'=>['comision'=>$mes3,'name'=>$name_mes3,'comision_t'=>$mes_t_3],'mes4'=>['comision'=>$mes4,'name'=>$name_mes4,'comision_t'=>$mes_t_4],'mes5'=>['comision'=>$mes5,'name'=>$name_mes5,'comision_t'=>$mes_t_5],'mes6'=>['comision'=>$mes6,'name'=>$name_mes6,'comision_t'=>$mes_t_6]];





         return      view('promoters.panel_control',compact('promoter','activaciones_mes','comisions_total','comisions_recibidas','comisions_pendientes','prospectos_visitados','comisions_totales_recibidas','comisions_totales_pendientes','prospectos_visitados_totales','plan_mi_agenda_spcialties','plan_profesional_spcialties','plan_platino_spcialties','plan_mi_agenda','plan_profesional','plan_platino','ingresosgrafica','p_ingresosgrafica'));
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

        $client = medico::where('promoter_id',$id)->paginate(10);
        $promoter = promoter::find($id);


       $suma = 0;
       $medicosC = medico::where('promoter_id',$id)->get();
       foreach ($medicosC as $medico) {
           $suma = $suma + $medico->records_of_plans_medico->sum('comision');
       }

       return view('promoters.list_client',compact('client','suma','promoter'));
     }

     public function list_client_activated(Request $request,$id){
       $client = medico::where('promoter_id',$id)->where('plan','!=','plan_basico')->whereNotNull('plan')->paginate(10);
       $promoter = promoter::find($id);
       $medicalCenters = medicalCenter::where('promoter_id',$id)->where('stateAccount', 'Activa')->get();
       // $client = $medicos->merge($medicalCenters);


        $suma = 0;

         $medicos2 = medico::where('promoter_id',$id)->get();
         $medicosC = medico::where('promoter_id',$id)->get();
         foreach ($medicosC as $medico) {
             $suma = $suma + $medico->records_of_plans_medico->sum('comision');
         }
       $active = 'si';
       return view('promoters.list_client',compact('client','suma','active','promoter'));
     }

     public function list_client_desactivated(Request $request,$id){

         $promoter = promoter::find($id);
       $client = medico::where('promoter_id',$id)
                ->whereNull('plan')
                ->orWhere(function ($query) use($id) {
                    $query->where('promoter_id',$id)
                    ->where('plan','==','plan_basico');

                })->paginate(10);


       $medicalCenters = medicalCenter::where('promoter_id',$id)->where('stateAccount', 'Desactivada')->get();

       $medicos2 = medico::where('promoter_id',$id)->get();
       $suma = 0;
       $medicosC = medico::where('promoter_id',$id)->get();
       foreach ($medicosC as $medico) {
           $suma = $suma + $medico->records_of_plans_medico->sum('comision');
       }
     $inactive = 'si';
     return view('promoters.list_client',compact('client','suma','inactive','promoter'));
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
            'identification'=>'required|unique:medicos',
            'name'=>'required',
            'lastName'=>'required',
            'gender'=>'required',
            'specialty'=>'required',
            'country'=>'required',
            'email'=>'required|unique:medicos|unique:users',
            // 'password'=>'required',
            //'medicalCenter_id'=>'required',

            'phone'=>'required|numeric',
            //'facebook'=>'required',

         ]);

         if($request->terminos == Null){
           return back()->with('warning', 'Debes Aceptar los Términos y Condiciones, para poder continuar.')->withInput();
         }

         $medico = new medico;
         $medico->fill($request->all());
         $medico->stateConfirm = 'medium';
         $medico->promoter_id = $request->promoter_id;
         $medico->password = bcrypt($request->password);
         $specialty = specialty::where('name', $request->specialty)->first();
         $medico->specialty_category = $specialty->specialty_category->name;
         $medico->save();

         $code = str_random(8);
         $user = new User;
         $user->medico_id = $medico->id;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = bcrypt($code);
         $user->password_send = $code; //<<<<<<<<<<<<//BORRAR //BORRAR//BORRAR//BORRAR
         $user->medico_id = $medico->id;
         $medico->stateConfirm = 'medium';
         $user->role = 'medico';
         $user->save();

         $role = Role::where('name','medico')->first();

         $user->attachRole($role);
         $promoter = promoter::find($request->promoter_id);

         Mail::send('mails.promoter_invited_medico',['medico'=>$medico,'code'=>$code,'promoter'=>$promoter],function($msj){
           $msj->subject('Médicos Si');
           $msj->to($medico->email);
        // $msj->to('eavc53189@gmail.com');
       });

           return redirect()->route('list_client',$request->promoter_id)->with('success', 'Se ha Registrado un nuevo Médico como su invitado, de forma simultanea se a enviado un mensaje al correo del médico recien agregado, con la información necesaria para  que pueda acceder a su cuenta Médicossi.');

     }

     // public function clientsPromoter($id)
     // {
     //
     //   $promoter = promoter::find($id);
     //
     //   $medicalCenters = medicalCenter::where('id_promoter',$promoter->id_promoter)->orderBy('name','asc')->paginate(10);
     //
     //   $medicos = medico::where('id_promoter',$promoter->id_promoter)->orderBy('id','desc')->paginate(10);
     //
     //     return view('promoters.clientsPromoter')->with('medicalCenters', $medicalCenters)->with('medicos', $medicos)->with('promoter', $promoter);
     // }

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
