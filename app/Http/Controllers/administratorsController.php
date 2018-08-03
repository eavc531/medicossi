<?php

namespace App\Http\Controllers;
use App\administrator;
use App\permission;
use App\city;
use App\cities_admin;
use App\user;
use App\Role;
use App\role_user;
use App\medico;
use DB;
use App\records_of_plans_medico;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class administratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function panel_control_administrator()
     {
         $id = 1;

        $month = \carbon\carbon::now()->endOfDay();

        $start_month = $month->startOfMonth()->format('Y-m-d H:i:s');
        $end_month = $month->endOfMonth()->format('Y-m-d H:i:s');

          $activaciones_mes = DB::table('medicos')
            ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
            ->select('records_of_plans_medicos.*')
            // ->where('records_of_plans_medicos.promoter_id', $id)
             ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)
            ->count();

            $Ganancias_recibidas = records_of_plans_medico::where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)
              ->sum('price');




              $comisions_recibidas = DB::table('records_of_plans_medicos')
                ->select('.*')
                // ->where('records_of_plans_medicos.promoter_id', $id)
                 ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)->where('state_payment', 'si')
                ->sum('comision');
                // dd($comisions_recibidas);

                 // dd();
                $comisions_pendientes = DB::table('medicos')
                  ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                  ->select('records_of_plans_medicos.*')
                  // ->where('records_of_plans_medicos.promoter_id', $id)
                   ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)->where('state_payment','!=','si')
                  ->sum('comision');
                  // dd($comisions_pendientes);
                  // $prospectos_visitados = medico::where('promoter_id',$id)->where('created_at','>',$start_month)->where('created_at','<', $end_month)->count();

                  $comisions_total_mes = DB::table('medicos')
                    ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                    ->select('records_of_plans_medicos.*')
                    ->where('records_of_plans_medicos.created_at','>',$start_month)->where('records_of_plans_medicos.created_at','<',$end_month)
                    ->sum('comision');

                    $Ganancias_recibidas_menos_comisiones = $Ganancias_recibidas - $comisions_total_mes;


                    $Ganancias_totales = records_of_plans_medico::sum('price');

                    $comisions_totales_recibidas = DB::table('medicos')
                      ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                      ->select('records_of_plans_medicos.*')
                      // ->where('records_of_plans_medicos.promoter_id', $id)
                      ->where('state_payment','si')
                      ->sum('comision');

                      $comisions_totales_pendientes = DB::table('medicos')
                        ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                        ->select('records_of_plans_medicos.*')
                        ->where('records_of_plans_medicos.promoter_id', $id)
                        // ->where('state_payment','!=','si')
                        ->sum('comision');

                        $comisions_total = DB::table('medicos')
                          ->join('records_of_plans_medicos', 'medicos.id', '=', 'records_of_plans_medicos.medico_id')
                          ->select('records_of_plans_medicos.*')
                          ->sum('comision');

                          $Ganancias_totales_menos_comisiones = $Ganancias_totales - $comisions_total;
                        // $prospectos_visitados_totales = medico::whereNotNull('promoter_id')->count();

                    //MEDICOS Y Especialistas
                    $plan_mi_agenda_spcialties = medico::where('Plan','plan_agenda')
                                            ->where('specialty_category','Medicos y Especialistas')
                                            ->count();

                    $plan_profesional_spcialties = medico::where('Plan','plan_profesional')
                                            ->where('specialty_category','Medicos y Especialistas')
                                            ->count();
                    $plan_platino_spcialties = medico::where('Plan','plan_platino')
                                            ->where('specialty_category','Medicos y Especialistas')
                                            ->count();


                    $plan_mi_agenda = medico::where('Plan','plan_agenda')
                                            ->where('specialty_category','!=','Medicos y Especialistas')
                                            ->count();

                    $plan_profesional = medico::where('Plan','plan_profesional')
                                            ->where('specialty_category','!=','Medicos y Especialistas')
                                            ->count();

                    $plan_platino = medico::where('Plan','plan_platino')
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

                    function calculate_ganancia($id,$start_month,$end_month){
                        $mes =  records_of_plans_medico::where('records_of_plans_medicos.created_at','>',$start_month)
                          ->where('records_of_plans_medicos.created_at','<',$end_month)
                          ->sum('price');


                         return $mes;
                    }
                    // GRAFICAS
                    //


                    $fecha_actual = \Carbon\Carbon::now();

                    $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                    $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                    $name_mes6 = day($fecha_actual->format('m'));

                     $mes6 = calculate_comision($id,$start_month,$end_month);
                     $mes_t_6 = calculate_ganancia($id,$start_month,$end_month);

                       $fecha_actual = \Carbon\Carbon::now()->subMonth();

                       $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                       $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                       $name_mes5 = day($fecha_actual->format('m'));
                        $mes5 = calculate_comision($id,$start_month,$end_month);
                        $mes_t_5 = calculate_ganancia($id,$start_month,$end_month);



                        $fecha_actual = \Carbon\Carbon::now()->subMonths(2);

                        $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                        $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                        $name_mes4 = day($fecha_actual->format('m'));
                         $mes4 = calculate_comision($id,$start_month,$end_month);
                         $mes_t_4 = calculate_ganancia($id,$start_month,$end_month);


                         $fecha_actual = \Carbon\Carbon::now()->subMonths(3);

                         $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                         $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                         $name_mes3 = day($fecha_actual->format('m'));
                         $mes3 = calculate_comision($id,$start_month,$end_month);
                         $mes_t_3 = calculate_ganancia($id,$start_month,$end_month);

                          $fecha_actual = \Carbon\Carbon::now()->subMonths(4);

                          $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                          $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                          $name_mes2 = day($fecha_actual->format('m'));
                           $mes2 = calculate_comision($id,$start_month,$end_month);
                           $mes_t_2 = calculate_ganancia($id,$start_month,$end_month);

                           $fecha_actual = \Carbon\Carbon::now()->subMonths(5);

                           $start_month = $fecha_actual->startOfMonth()->format('Y-m-d H:i:s');
                           $end_month = $fecha_actual->endOfMonth()->format('Y-m-d H:i:s');

                           $name_mes1 = day($fecha_actual->format('m'));

                           $mes1 = calculate_comision($id,$start_month,$end_month);
                           $mes_t_1 = calculate_ganancia($id,$start_month,$end_month);


                            $ingresosgrafica = ['mes1'=>['comision'=>$mes1,'name'=>$name_mes1,'comision_t'=>$mes_t_1],'mes2'=>['comision'=>$mes2,'name'=>$name_mes2,'comision_t'=>$mes_t_2],'mes3'=>['comision'=>$mes3,'name'=>$name_mes3,'comision_t'=>$mes_t_3],'mes4'=>['comision'=>$mes4,'name'=>$name_mes4,'comision_t'=>$mes_t_4],'mes5'=>['comision'=>$mes5,'name'=>$name_mes5,'comision_t'=>$mes_t_5],'mes6'=>['comision'=>$mes6,'name'=>$name_mes6,'comision_t'=>$mes_t_6]];





         return      view('administrators.panel_control',compact('promoter','activaciones_mes','comisions_total_mes','comisions_recibidas','comisions_pendientes','comisions_totales_recibidas','comisions_totales_pendientes','plan_mi_agenda_spcialties','plan_profesional_spcialties','plan_platino_spcialties','plan_mi_agenda','plan_profesional','plan_platino','ingresosgrafica','p_ingresosgrafica','Ganancias_recibidas','Ganancias_recibidas_menos_comisiones','comisions_total','Ganancias_recibidas_menos_comisiones','Ganancias_totales','Ganancias_totales_menos_comisiones'));
     }


    public function index()
    {

      $administrators = administrator::orderBy('id','desc')->paginate(10);
        return view('administrators.index')->with('administrators', $administrators);
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
        'name'=> 'required|'.Rule::unique('cities_admins')->where('administrator_id',$request->administrator_id),
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
        return view('administrators.create');
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
           'lastName'=>'required',
           'email'=>'required|unique:users',
           'password'=>'required',
        ]);

        $administrator = new administrator;
        $administrator->fill($request->all());
        $administrator->save();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->administrator_id = $administrator->id;
        $user->role == 'Administrator';
        $user->save();
        $role = Role::where('name','admin')->first();

        $user->attachRole($role);
         return redirect()->route('administrators.index')->with('success', 'Se ha creado un nuevo Administrador de Forma Satisfactoria');

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
      $administrator = administrator::find($id);
        return view('administrators.edit')->with('administrator', $administrator);
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
      $user = User::find($id);
      $administrator = administrator::find($id);
      if($request->email != $administrator->email){
        $request->validate([
          'email'=>'required|unique:users|unique:administrators'
        ]);
        $administrator->email = $request->email;
        $user->email = $request->email;
      }

      $name = $administrator->name;
        $request->validate([
          'name'=>'required',
          'lastName'=>'required',
          'email'=>'required'
        ]);

        $administrator->name = $request->name;
        $administrator->lastName = $request->lastName;
        $administrator->save();


        $user->name = $request->name;

        if($request->password != Null){
            $user->password = bcrypt($request->password);
        }

        $user->administrator_id = $administrator->id;
        $user->save();
        return redirect()->route('administrators.index')->with('success', 'Los datos del Administrador: '.$name.' han sido Actualizados.');
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
