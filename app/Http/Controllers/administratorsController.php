<?php

namespace App\Http\Controllers;
use App\administrator;
use App\permission;
use App\city;
use App\cities_admin;
use App\user;
use App\Role;
use App\role_user;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class administratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
