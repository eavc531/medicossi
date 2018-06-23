<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\medico;
use App\medicalCenter;
use App\specialty;
use App\medico_specialty;
use DB;
use Auth;
use Geocoder;
use App\state;
use App\city;
use App\consulting_room;
use App\photo;
use Input;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

      class HomeController extends Controller
      {

        public function autocomplete_specialty(){
          $specialtyName = request()->input('term');
          $specialty = specialty::where('name','LIKE','%'.$specialtyName.'%')->get();

          foreach ($specialty as $query)
          	{
          	    $results[] = ['id'=>$query->id,'value'=>$query->name];
          	}

          return response()->json($results);
        }

        public function __construct(){
          $states = state::orderby('name','asc')->pluck('name','name');
          $cities = city::orderby('name','asc')->pluck('name','name');
          $this->states = $states;
          $this->cities = $cities;
        }

        public function home(){

          $medicos_json = '';
          if(auth::check()){
            $user = user::find(Auth::user()->id);
            return view('home.home')->with('user', $user)->with('medicos_json', $medicos_json)->with('states', $this->states)->with('cities',$this->cities);
          }

          return view('home.home')->with('medicos_json', $medicos_json)->with('states', $this->states)->with('cities',$this->cities);

        }

        public function calculate_dist_to_array($medicos,$dist,$lat,$lng){

          $data = [];
          //ordenar array
          foreach ($medicos as $medico){
            if($medico->latitud != Null and $medico->longitud != Null){
              //Haversine
              $myLat = deg2rad($lat);
              //$myLat = deg2rad($myCoordinates['lat']);
              $myLng = deg2rad($lng);
              //$myLng = deg2rad($myCoordinates['lng']);
              $medicLat = deg2rad($medico->latitud);
              $medicLng = deg2rad($medico->longitud);

              $latDelta = $medicLat - $myLat;
              $lonDelta = $medicLng - $myLng;

              $earthRadius = 6371; //en km

              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($myLat) * cos($medicLat) * pow(sin($lonDelta / 2), 2)));
              $distCalculate =  $angle * $earthRadius;


              if($dist > $distCalculate or $dist == Null){
                $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();
                $photo = photo::where('medico_id',$medico->id)->where('type', 'perfil')->first();
                if($photo == Null){
                  $image = Null;
                }else{
                  $image = $photo->path;
                }

                $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'dist'=>$distCalculate,'consulting_room'=>$consulting_room,'specialty'=>$medico->specialty,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud,'image'=>$image,'calification'=>$medico->calification, 'votes'=>$medico->votes,'plan'=>$medico->plan];
              }
            }

          }
          return $data;
        }

        public function calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng){
          $data = [];
          //ordenar array

          foreach ($medicalCenter as $medico) {
            //Haversine
            if($medico->latitud != Null and $medico->longitud != Null){
              $myLat = deg2rad($lat);
              //$myLat = deg2rad($myCoordinates['lat']);

              $myLng = deg2rad($lng);
              //$myLng = deg2rad($myCoordinates['lng']);

              $medicLat = deg2rad($medico->latitud);
              $medicLng = deg2rad($medico->longitud);

              $latDelta = $medicLat - $myLat;
              $lonDelta = $medicLng - $myLng;

              $earthRadius = 6371; //en km

              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($myLat) * cos($medicLat) * pow(sin($lonDelta / 2), 2)));
              $distCalculate =  $angle * $earthRadius;



                if($dist > $distCalculate or $dist == Null){
                  $photo = photo::where('medicalCenter_id',$medico->id)->where('type', 'perfil')->first();
                  if($photo == Null){
                    $image = Null;
                  }else{
                    $image = $photo->path;
                  }

                  $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'city'=>$medico->city,'state'=>$medico->state,'dist'=>$distCalculate,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud,'image'=>$image,'plan'=>$medico->plan];
                }

            }

            }

          return $data;
        }

        public function create_array_medicos($medicos){

          $data = [];
          foreach ($medicos as $medico) {
          $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();
          $photo = photo::where('medico_id',$medico->id)->where('type', 'perfil')->first();
          if($photo == Null){
            $image = Null;
          }else{
            $image = $photo->path;
          }

          $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'consulting_room'=>$consulting_room,'specialty'=>$medico->specialty,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud,'image'=>$image,'calification'=>$medico->calification, 'votes'=>$medico->votes,'plan'=>$medico->plan];
          }

          return $data;
        }

        public function paginate_custom($data,$currentPage){

          $col = new Collection($data);
          $perPage = 4;
          $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
          $medicosCerc = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
          $medicosCerc->setPath(route('tolist2'));
          return $medicosCerc;
        }

        public function tolist3(Request $request){

          if($request->typeSearch == 'Especialidad Medica' or $request->typeSearch2 == 'Especialidad Medica'){
          //**Especialidad medica x ciudad**/

            if($request->city != null){
              if($request->city != 'ciudad'){
                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                ->Join('cities', 'medicos.city_id', '=', 'cities.id')
                ->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*')
                ->where('medicos.specialty','=',$request->search)
                ->Where('cities.name','=',$request->city)
                ->get();

                  $data = HomeController::create_array_medicos($medicos);
                  $currentPage = LengthAwarePaginator::resolveCurrentPage();
                  $medicosCerc = HomeController::paginate_custom($data,$currentPage);
                  $medicosCercCount = count($medicosCerc);

                  return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('typeSearch2', $request->typeSearch2);
              }
            }

            //especialidad por Estado
            if($request->state != null){
                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                //->Join('cities', 'medicos.city_id', '=', 'cities.id')
                //->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*')
                ->where('medicos.specialty','=',$request->search)
                ->Where('medicos.state','=',$request->state)
                ->get();
                  $data = HomeController::create_array_medicos($medicos);
                  $currentPage = LengthAwarePaginator::resolveCurrentPage();
                  $medicosCerc = HomeController::paginate_custom($data,$currentPage);
                  $medicosCercCount = count($medicosCerc);
                  return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('typeSearch2', $request->typeSearch2);
            }
            //**Especialidad medica por distancia**///

            $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*')
            ->where('medicos.specialty','=',$request->search)
            ->get();
          $data = HomeController::calculate_dist_to_array($medicos,$dist);
          $currentPage = LengthAwarePaginator::resolveCurrentPage();
          $medicosCerc = HomeController::paginate_custom($data,$currentPage);
          $medicosCercCount = count($medicosCerc);

          return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('typeSearch2', $request->typeSearch2);
        }

        }
        public function tolist2(Request $request){
          // dd($request->all());
          if(!isset($request->typeSearch2)){
            $request->validate([
              'typeSearch'=>'required'
            ]);
          }

          $lat = $request->latitud;
          $lng = $request->longitud;
          $dist = $request->dist;

          if($request->typeSearch2 == 'Medicos de la Institucion'){
              $medicos = medico::where('medicalCenter_id',$request->medicalCenter_id)->get();
              $data = HomeController::create_array_medicos($medicos);

              if($request->filter_ranking == 'si'){
                $data = collect($data)->sortByDesc('calification')->toArray();
              }else{
                $data = collect($data)->sortBy('dist')->toArray();
              }
              $currentPage = LengthAwarePaginator::resolveCurrentPage();
              $medicosCerc = HomeController::paginate_custom($data,$currentPage);

              $medicosCercCount = count($medicosCerc);

              return view('home.home')->with('medicosCerc', $medicosCerc)->with('medicosCercCount', $medicosCercCount)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('search', 'Medicos de la institucion')->with('typeSearch2', $request->typeSearch2);
          }
          //Centro Medico por nombre
          //Centro Medico DISTANCIA
          if($request->typeSearch == 'Centro Medico'){

              if($dist != null){
                $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->get();
                $data = HomeController::calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng);
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $medicalCenter = HomeController::paginate_custom($data,$currentPage);
                $medicalCenterCount = count($medicalCenter);
                //dd($medicalCenterCount);

                return view('home.home')->with('medicalCenter', $medicalCenter)->with('medicalCenterCount', $medicalCenterCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);
              }
              if($request->city != null and $request->city != 'ciudad'){
                $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->Where('city',$request->city)
                ->get();
                $data = HomeController::calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng);
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $medicalCenter = HomeController::paginate_custom($data,$currentPage);
                $medicalCenterCount = count($medicalCenter);
                //dd($medicalCenterCount);
                return view('home.home')->with('medicalCenter', $medicalCenter)->with('medicalCenterCount', $medicalCenterCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);
              }

              if($request->state != null){

                $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->Where('state',$request->state)
                ->get();
                $data = HomeController::calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng);
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $medicalCenter = HomeController::paginate_custom($data,$currentPage);
                $medicalCenterCount = count($medicalCenter);
                //dd($medicalCenterCount);
                return view('home.home')->with('medicalCenter', $medicalCenter)->with('medicalCenterCount', $medicalCenterCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);
              }
            $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->get();
            $medicalCenterCount = medicalCenter::where('name','LIKE','%'.$request->search.'%')->count();
            //dd($medicalCenter);
            $data = [];
            foreach ($medicalCenter as $mc) {
              $photo = photo::where('medicalCenter_id',$mc->id)->where('type', 'perfil')->first();
              if($photo == Null){
                $image = Null;
              }else{
                $image = $photo->path;
              }
            $data[$mc->id] = ['id'=>$mc->id,'name'=>$mc->name,'city'=>$mc->city,'state'=>$mc->state,'longitud'=>$mc->longitud,'latitud'=>$mc->latitud,'image'=>$image];
            }

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $medicalCenter = HomeController::paginate_custom($data,$currentPage);
            $medicalCenterCount = count($medicalCenter);
            //dd($medicalCenterCount);
            return view('home.home')->with('medicalCenter', $medicalCenter)->with('medicalCenterCount', $medicalCenterCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);

          }

          if(isset($request->typeSearchSpecialty)){ //necesario
            $typeSearchSpecialty = $request->typeSearch2;
          }else{
            $typeSearchSpecialty = null;
          }

          //**Especialidad medica
          if($request->typeSearch == 'Especialidad Medica' or $request->typeSearch2 == 'Especialidad Medica'){
          //**Especialidad medica x ciudad**/

            if($request->city != null){
              if($request->city != 'ciudad'){
                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                ->Join('cities', 'medicos.city_id', '=', 'cities.id')
                ->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*')
                ->where('medicos.specialty','=',$request->search)
                ->Where('cities.name','=',$request->city)
                ->get();

                  $data = HomeController::create_array_medicos($medicos);
                  if($request->filter_ranking == 'si'){
                    $data = collect($data)->sortByDesc('calification')->toArray();
                  }else{
                    $data = collect($data)->sortBy('dist')->toArray();
                  }
                  $currentPage = LengthAwarePaginator::resolveCurrentPage();
                  $medicosCerc = HomeController::paginate_custom($data,$currentPage);
                  $medicosCercCount = count($medicosCerc);

                  return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('typeSearch2', $request->typeSearch2);
              }
            }


            //especialidad por Estado
            if($request->state != null){
                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                //->Join('cities', 'medicos.city_id', '=', 'cities.id')
                //->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*')
                ->where('medicos.specialty','=',$request->search)
                ->Where('medicos.state','=',$request->state)
                ->get();
                  $data = HomeController::create_array_medicos($medicos);
                  if($request->filter_ranking == 'si'){
                    $data = collect($data)->sortByDesc('calification')->toArray();
                  }else{
                    $data = collect($data)->sortBy('dist')->toArray();
                  }
                  $currentPage = LengthAwarePaginator::resolveCurrentPage();
                  $medicosCerc = HomeController::paginate_custom($data,$currentPage);
                  $medicosCercCount = count($medicosCerc);
                  return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('typeSearch2', $request->typeSearch2);
            }
            //**Especialidad medica por distancia**///



            $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*')
            ->where('medicos.specialty','=',$request->search)
            ->get();
          $data = HomeController::calculate_dist_to_array($medicos,$dist,$lat,$lng);
          if($request->filter_ranking == 'si'){
            $data = collect($data)->sortByDesc('calification')->toArray();
          }else{
            $data = collect($data)->sortBy('dist')->toArray();
          }

          $currentPage = LengthAwarePaginator::resolveCurrentPage();
          $medicosCerc = HomeController::paginate_custom($data,$currentPage);
          $medicosCercCount = count($medicosCerc);

          return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities)->with('typeSearch2', $request->typeSearch2);
        }
      //NOMBRE/celdula DEL MEDICO//NOMBRE DEL MEDICO//NOMBRE DEL MEDICO

        if($request->typeSearch == 'Nombre/Cedula del Medico'){


          if($request->city != null and $request->city != 'ciudad'){
            if($request->city != 'ciudad'){
              $medicos = DB::table('medicos')
              //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->Join('cities', 'medicos.city_id', '=', 'cities.id')
              ->Join('states', 'medicos.state_id', '=', 'states.id')
              ->select('medicos.*')
              //->where('cities.name','=',$request->city)
              ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
              //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
              ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
              ->get();


              $data = [];
              foreach ($medicos as $medico){


                if($medico->city == $request->city){
                  $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();
                  $photo = photo::where('medicalCenter_id',$medico->id)->where('type', 'perfil')->first();
                    if($photo == Null){
                      $image = Null;
                    }else{
                      $image = $photo->path;
                    }

                  $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'consulting_room'=>$consulting_room,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud,'image'=>$image,'calification'=>$medico->calification, 'votes'=>$medico->votes,'plan'=>$medico->plan];
                }
              }

              if($request->filter_ranking == 'si'){
                $data = collect($data)->sortByDesc('calification')->toArray();
              }else{
                $data = collect($data)->sortBy('dist')->toArray();
              }




              $currentPage = LengthAwarePaginator::resolveCurrentPage();
              $medicosCerc = HomeController::paginate_custom($data,$currentPage);
              $medicosCercCount = count($medicosCerc);

              return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('typeSearchSpecialty', $typeSearchSpecialty)->with('states', $this->states)->with('cities',$this->cities);

            }
            }


            //estado
            if($request->state != null and $request->state != 'estado'){
                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                ->Join('cities', 'medicos.city_id', '=', 'cities.id')
                ->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*')
                //->where('cities.name','=',$request->city)
                ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
                //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
                ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
                ->get();

                $data = [];
                foreach ($medicos as $medico) {
                  if($medico->state == $request->state){
                    $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();
                    $photo = photo::where('medico_id',$medico->id)->where('type', 'perfil')->first();
                    if($photo == Null){
                      $image = Null;
                    }else{
                      $image = $photo->path;
                    }
                    $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'consulting_room'=>$consulting_room,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud,'image'=>$image,'calification'=>$medico->calification, 'votes'=>$medico->votes,'plan'=>$medico->plan
                  ];
                  }
                }


                if($request->filter_ranking == 'si'){
                  $data = collect($data)->sortByDesc('calification')->toArray();
                }else{
                  $data = collect($data)->sortBy('dist')->toArray();
                }
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $medicosCerc = HomeController::paginate_custom($data,$currentPage);
                $medicosCercCount = count($medicosCerc);


                return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('typeSearchSpecialty', $typeSearchSpecialty)->with('states', $this->states)->with('cities',$this->cities);
              }
              //busqueda nombre normal
              ;
              $dist = $request->dist;

              if($request->dist != Null){
                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                  // ->Join('cities', 'medicos.city_id', '=', 'cities.id')
                  // ->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*')
                ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
                //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
                ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
                ->get();

              $data = HomeController::calculate_dist_to_array($medicos,$dist,$lat,$lng);
              if($request->filter_ranking == 'si'){
                $data = collect($data)->sortByDesc('calification')->toArray();
              }else{
                $data = collect($data)->sortBy('dist')->toArray();
              }


              $currentPage = LengthAwarePaginator::resolveCurrentPage();
              $medicosCerc = HomeController::paginate_custom($data,$currentPage);
              $medicosCercCount = count($medicosCerc);
              //dd($medicosCerc);
              return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('typeSearchSpecialty', $typeSearchSpecialty)->with('states', $this->states)->with('cities',$this->cities);
            //fin NOMBRE/CEDULA MEDIC

              }

            $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              // ->Join('cities', 'medicos.city_id', '=', 'cities.id')
              // ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*')
            ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
            //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
            ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
            ->get();

          $data = HomeController::create_array_medicos($medicos,$dist,$lat,$lng);
            // if(isset())
            if($request->filter_ranking == 'si'){
              $data = collect($data)->sortByDesc('calification')->toArray();
            }else{
              $data = collect($data)->sortBy('dist')->toArray();
            }

          // dd($data);

          $currentPage = LengthAwarePaginator::resolveCurrentPage();
          $medicosCerc = HomeController::paginate_custom($data,$currentPage);
          $medicosCercCount = count($medicosCerc);
          //dd($medicosCerc);
          return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('typeSearchSpecialty', $typeSearchSpecialty)->with('states', $this->states)->with('cities',$this->cities);
        //fin NOMBRE/CEDULA MEDIC
          }

          if($request->typeSearch == Null or $request->typeSearch2 == Null){
            return redirect()->route('home');
          }

      }

      public function specialtyList1(Request $request){
        $specialties = specialty::where('specialty_category_id',1)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',1)->count();
        $category = 'Médicos y Especialistas';

        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }

      public function specialtyList2(Request $request){
        $specialties = specialty::where('specialty_category_id',2)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',2)->count();
        $category = 'Dentistas';
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }

      public function specialtyList3(Request $request){
        $specialties = specialty::where('specialty_category_id',3)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',3)->count();
        $category = 'Medicina Alternativa';
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }

      public function specialtyList4(Request $request){
        $specialties = specialty::where('specialty_category_id',4)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',4)->count();
        $category = 'Terapeutas y Nutricion';
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }


      public function medical_search_name(Request $request){
        $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->paginate(10);
        $medicalCenterCount = medicalCenter::where('name','LIKE','%'.$request->search.'%')->paginate(10);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();


        return view('home.home')->with('medicalCenter', $medicalCenter)->with('medicalCenterCount', $medicalCenterCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);
        dd('sd');
      }


      public function ajax_map(Request $request){
        // return response()->json($request->all());
        $lat = $request->latitud;
        $lng = $request->longitud;

        $numberPageNow = ($request->numberPageNow * 4) -4;
        $dist = $request->dist;

        if($request->typeSearch2 == 'Medicos de la Institucion'){
            $medicos = medico::where('medicalCenter_id',$request->medicalCenter_id)->get();
            $data = HomeController::create_array_medicos($medicos);
            $data = array_slice($data,$numberPageNow, 4);
            if($request->filter_ranking == 'si'){
              $data = collect($data)->sortByDesc('calification')->toArray();
            }else{
              $data = collect($data)->sortBy('dist')->toArray();
            }
            return response()->json($data);
        }
        //Centro Medico por nombre
        $dist = $request->dist;
        //Centro Medico DISTANCIA
        if($request->typeSearch == 'Centro Medico'){
            if($dist != null){
              $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->get();
              $data = HomeController::calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng);
              $data = array_slice($data,$numberPageNow, 4);
              return response()->json($data);
            }
            if($request->city != null and $request->city != 'ciudad'){
              $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->Where('city',$request->city)
              ->get();
              $data = HomeController::calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng);
              $data = array_slice($data,$numberPageNow, 4);
              return response()->json($data);
            }

            if($request->state != null){

              $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->Where('state',$request->state)
              ->get();
              $data = HomeController::calculate_dist_to_array_medicalCenter($medicalCenter,$dist,$lat,$lng);
              $data = array_slice($data,$numberPageNow, 4);
              return response()->json($data);
            }

          $medicalCenter = medicalCenter::where('name','LIKE','%'.$request->search.'%')->get();
          $medicalCenterCount = medicalCenter::where('name','LIKE','%'.$request->search.'%')->count();
          //dd($medicalCenter);
          $data = [];
          foreach ($medicalCenter as $mc) {

          $data[$mc->id] = ['id'=>$mc->id,'name'=>$mc->name,'city'=>$mc->city,'state'=>$mc->state,'longitud'=>$mc->longitud,'latitud'=>$mc->latitud];
          }

          $data = array_slice($data,$numberPageNow, 4);
          return response()->json($data);

        }

        if(isset($request->typeSearchSpecialty)){ //necesario
          $typeSearchSpecialty = $request->typeSearch2;
        }else{
          $typeSearchSpecialty = null;
        }

        //**Especialidad medica
        if($request->typeSearch == 'Especialidad Medica' or $request->typeSearch2 == 'Especialidad Medica'){
        //**Especialidad medica x ciudad**/


          if($request->city != null){
            if($request->city != 'ciudad'){
              $medicos = DB::table('medicos')
              //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->Join('cities', 'medicos.city_id', '=', 'cities.id')
              ->Join('states', 'medicos.state_id', '=', 'states.id')
              ->select('medicos.*')
              ->where('medicos.specialty','=',$request->search)
              ->Where('cities.name','=',$request->city)
              ->get();

                $data = HomeController::create_array_medicos($medicos);
                if($request->filter_ranking == 'si'){
                  $data = collect($data)->sortByDesc('calification')->toArray();
                }else{
                  $data = collect($data)->sortBy('dist')->toArray();
                }
                $data = array_slice($data,$numberPageNow, 4);
                return response()->json($data);


            }
          }

          //especialidad por Estado

          if($request->state != null){
              $medicos = DB::table('medicos')
              //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              //->Join('cities', 'medicos.city_id', '=', 'cities.id')
              //->Join('states', 'medicos.state_id', '=', 'states.id')
              ->select('medicos.*')
              ->where('medicos.specialty','=',$request->search)
              ->Where('medicos.state','=',$request->state)
              ->get();
                $data = HomeController::create_array_medicos($medicos);
                $data = array_slice($data,$numberPageNow, 4);
                if($request->filter_ranking == 'si'){
                  $data = collect($data)->sortByDesc('calification')->toArray();
                }else{
                  $data = collect($data)->sortBy('dist')->toArray();
                }
                return response()->json($data);
          }
          //**Especialidad medica por distancia**///
          $medicos = DB::table('medicos')
          //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
          ->Join('cities', 'medicos.city_id', '=', 'cities.id')
          ->Join('states', 'medicos.state_id', '=', 'states.id')
          ->select('medicos.*')
          ->where('medicos.specialty','=',$request->search)
          ->get();

        $data = HomeController::calculate_dist_to_array($medicos,$dist,$lat,$lng);
        if($request->filter_ranking == 'si'){
          $data = collect($data)->sortByDesc('calification')->toArray();
        }else{
          $data = collect($data)->sortBy('dist')->toArray();
        }
        $data = array_slice($data,$numberPageNow, 4);
        return response()->json($data);
      }
      ///<<<<zzzzz/////
    //NOMBRE/celdula DEL MEDICO//NOMBRE DEL MEDICO//NOMBRE DEL MEDICO
      if($request->typeSearch == 'Nombre/Cedula del Medico'){

        if($request->city != null and $request->city != 'ciudad'){
          if($request->city != 'ciudad'){
            $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*')
            //->where('cities.name','=',$request->city)
            ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
            //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
            ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
            ->get();

            $data = [];
            foreach ($medicos as $medico) {
              if($medico->city == $request->city){
                $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();
                $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'consulting_room'=>$consulting_room,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud];
              }
            }

            if($request->filter_ranking == 'si'){
              $data = collect($data)->sortByDesc('calification')->toArray();
            }else{
              $data = collect($data)->sortBy('dist')->toArray();
            }
            $data = array_slice($data,$numberPageNow, 4);
            return response()->json($data);
          }
          }
          //estado
          if($request->state != null and $request->state != 'estado'){

              $medicos = DB::table('medicos')
              //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->Join('cities', 'medicos.city_id', '=', 'cities.id')
              ->Join('states', 'medicos.state_id', '=', 'states.id')
              ->select('medicos.*')
              //->where('cities.name','=',$request->city)
              ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
              //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
              ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
              ->get();

              $data = [];
              foreach ($medicos as $medico) {
                if($medico->state == $request->state){
                  $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();
                  $data[$medico->id] = ['id'=>$medico->id,'identification'=>$medico->identification,'name'=>$medico->name,'lastName'=>$medico->lastName,'city'=>$medico->city,'state'=>$medico->state,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'consulting_room'=>$consulting_room,'latitud'=>$medico->latitud,'longitud'=>$medico->longitud];
                }
              }

              if($request->filter_ranking == 'si'){
                $data = collect($data)->sortByDesc('calification')->toArray();
              }else{
                $data = collect($data)->sortBy('dist')->toArray();
              }
              $data = array_slice($data,$numberPageNow, 4);
              return response()->json($data);
            }
            //busqueda nombre normal
          $dist = $request->dist;
            if($request->dist != Null){
              $medicos = DB::table('medicos')
              //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                // ->Join('cities', 'medicos.city_id', '=', 'cities.id')
                // ->Join('states', 'medicos.state_id', '=', 'states.id')
              ->select('medicos.*')
              ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
              //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
              ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
              ->get();

            $data = HomeController::calculate_dist_to_array($medicos,$dist,$lat,$lng);
            if($request->filter_ranking == 'si'){
              $data = collect($data)->sortByDesc('calification')->toArray();
            }else{
              $data = collect($data)->sortBy('dist')->toArray();
            }
            $data = array_slice($data,$numberPageNow, 4);
            return response()->json($data);
          //fin NOMBRE/CEDULA MEDIC

            }

          $medicos = DB::table('medicos')
          //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            // ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            // ->Join('states', 'medicos.state_id', '=', 'states.id')
          ->select('medicos.*')
          ->where('medicos.nameComplete','LIKE','%'.$request->search.'%')
          //->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
          ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
          ->get();


        $data = HomeController::create_array_medicos($medicos,$dist);
        if($request->filter_ranking == 'si'){
          $data = collect($data)->sortByDesc('calification')->toArray();
        }else{
          $data = collect($data)->sortBy('dist')->toArray();
        }
        $data = array_slice($data,$numberPageNow, 4);
        return response()->json($data);
      //fin NOMBRE/CEDULA MEDIC

      }

      }

      public function detail_medic_map($id){
        $medico = medico::find($id);
        $photo = photo::where('medico_id',$medico->id)->where('type', 'perfil')->first();


        return view('home.detail_medic_map')->with('medico', $medico)->with('photo', $photo );
      }

}
