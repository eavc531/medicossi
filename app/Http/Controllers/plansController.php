<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\plan;
use App\city;
use App\cities_plan;
use App\medico;
use App\specialty;
use App\records_of_plans_medico;
//use App\specialty_category;

class plansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function set_plan(Request $request){

       if($request->pricePlan == null){
         return back()->with('warning','Debes seleccionar el tiempo determinado para el que quieres contratar al plan '.$request->namePlan);
       }

       $medico = medico::find($request->medico_id);
       if($request->namePlan == 'Plan Basico'){
         $medico->plan = 'plan_basico';
       }elseif($request->namePlan == 'Plan Mi Agenda'){
         $medico->plan = 'plan_agenda';
       }elseif($request->namePlan == 'Plan Profesional'){
         $medico->plan = 'plan_profesional';
       }elseif($request->namePlan == 'Plan Platino'){
         $medico->plan = 'plan_platino';
       }
          $medico->save();

          $record = new records_of_plans_medico;
          $record->medico_id = $request->medico_id;
          $record->name = $request->namePlan;
          $record->price = $request->pricePlan;
          $record->period = $request->period;
          $record->date_start = \Carbon\Carbon::now();

          if($request->period == 'anual'){
            $date_end = \Carbon\Carbon::now()->addYear();

          }elseif($request->period == '6 meses'){
            $date_end = \Carbon\Carbon::now()->addMonths(6);

          }elseif($request->period == 'mensual'){
            $date_end = \Carbon\Carbon::now()->addMonth();
          }

          $record->date_end = $date_end;
          $record->save();

        return redirect()->route('home');
     }

     public function plan_agenda_contract($id){
       $medico = medico::find($id);
       $specialty = specialty::where('name', $medico->specialty)->first();


        if($specialty->specialty_category->name != 'Medicos y Especialistas'){
          $plan = plan::where('name','Plan Mi Agenda')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();
        }else{
          $plan = plan::where('name','Plan Mi Agenda')->where('applicable','Medicos y Especialistas' )->first();
        }

       return view('plans.select_subscription',compact('medico','plan'));
     }

     public function plan_profesional_contract($id){
       $medico = medico::find($id);
       $specialty = specialty::where('name', $medico->specialty)->first();

        if($specialty->specialty_category->name != 'Medicos y Especialistas'){
          $plan = plan::where('name','Plan Profesional')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();
        }else{
          $plan = plan::where('name','Plan Profesional')->where('applicable','Medicos y Especialistas' )->first();
        }

       return view('plans.select_subscription',compact('medico','plan'));
     }



     public function plan_platino_contract($id){

       $medico = medico::find($id);
       $specialty = specialty::where('name', $medico->specialty)->first();

        if($specialty->specialty_category->name != 'Medicos y Especialistas'){
          $plan = plan::where('name','Plan Platino')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();
        }else{
          $plan = plan::where('name','Plan Platino')->where('applicable','Medicos y Especialistas' )->first();
        }
        
       return view('plans.select_subscription',compact('medico','plan'));
     }

     public function contract_basic($id){
       $medico = medico::find($id);
       if($medico->plan != 'plan_agenda' and $medico->plan != 'plan_profesional' and $medico->plan != 'plan_platino'){
         $medico->plan = 'plan_basico';
         $medico->save();
       }else{
         return back()->with('warning','Imposible realizar accion, posees un plan activo con mayores beneficios, al vencerse se estableceran automaticamente los ajustes del Plan basico');
       }

       return view('plans.success_plan_basic');
     }

     public function planes_medic($id){
       $medico = medico::find($id);


       $specialty = specialty::where('name', $medico->specialty)->first();


       if($specialty->specialty_category->name != 'Medicos y Especialistas'){
         $plan_basico = plan::where('name','Plan Basico')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();

          $plan_mi_agenda = plan::where('name','Plan Mi Agenda')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();

          $plan_profesional = plan::where('name','Plan Profesional')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();

          $plan_platino = plan::where('name','Plan Platino')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();
       }else{
         $plan_basico = plan::where('name','Plan Basico')->where('applicable',$specialty->specialty_category->name )->first();

         $plan_mi_agenda = plan::where('name','Plan Mi Agenda')->where('applicable', $specialty->specialty_category->name)->first();

         $plan_profesional = plan::where('name','Plan Profesional')->where('applicable', $specialty->specialty_category->name)->first();

         $plan_platino = plan::where('name','Plan Platino')->where('applicable', $specialty->specialty_category->name)->first();

       }

       $plan_actual = records_of_plans_medico::where('medico_id',$id)->orderBy('date_start','desc')->first();

       return view('plans.planes_promotions',compact('plan_mi_agenda','plan_profesional','plan_platino','plan_actual'));
     }

     public function planes(){
       return view('plans.professional-promotions');
     }

    public function index()
    {
        $plans1 = plan::where('applicable','Medicos y Especialistas')->get();

        $plans2 = plan::where('applicable','Medicina Alternativa, Psicologos y Terapeutas')->get();

        $plans3 = plan::where('applicable','Nucleos Medicos')->get();

        return view('plans.index')->with('plans1', $plans1)->with('plans2', $plans2)->with('plans3', $plans3);

    }

    public function deleteCityplan($id)
    {
        $cities_plan = cities_plan::find($id);
        $city1 = $cities_plan->name;
        cities_plan::destroy($id);

        return back()->with('danger', 'Se ha desabilitado la ciudad '.$city1.' para este Plan');
    }


    public function citiesPlansStore(Request $request)
    {
      $request->validate([
        'name'=> 'required|'.Rule::unique('cities_plans')->where('plan_id',$request->plan_id),
      ]);

        $city = new cities_plan;
        $city->name = $request->name;
        $city->plan_id = $request->plan_id;
        $city->save();

        $plan = plan::find($request->plan_id);
        return back()->with('success', 'Se a asigando una nueva ciudad al Plan: '.$plan->name);
    }

      public function citiesPlans($id)
      {
          $citiesAll = city::orderBy('name','asc')->pluck('name','name');
          $citiesPlans = cities_plan::where('plan_id',$id)->paginate(10);

          $plan = plan::find($id);

          return view('plans.citiesPlans')->with('citiesPlans', $citiesPlans)->with('citiesAll', $citiesAll)->with('plan', $plan);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          'price1'=>'required|numeric',
          'price2'=>'required|numeric',
          'price3'=>'required|numeric',
        ]);

        $plan = plan::find($request->plan_id);
        $plan->price1 = $request->price1;
        $plan->price2 = $request->price2;
        $plan->price3 = $request->price3;
        $plan->save();

        return back()->with('success', 'El precio del plan: '.$plan->name.' ha sido Cambiado con Exito');
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
