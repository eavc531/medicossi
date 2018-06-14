<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\medico::class)->times(6)->create();
        $this->call('specialty_category');
        $this->call('specialty');
        $this->call('statesAndCities');
        $this->call('insurrance_show');
        $this->call('note_seeder');


        DB::table('countries')->insert([
       'name'=>'México',
       ]);

       DB::table('countries')->insert([
      'name'=>'Peru',
      ]);

      DB::table('countries')->insert([
     'name'=>'Chile',
     ]);

        DB::table('users')->insert([
       'name'=>'admin',
       'email'=>'admin@admin.com',
       'password'=>bcrypt('1234'),
       'role'=>'Administrador',
       ]);

          DB::table('medicos')->insert([
         'name'=>'med',
         'lastName'=>'med',
         'gender'=>'Masculino',
         'email'=>'eavcssss@hotmail.com',
         'password'=>bcrypt('124578'),
         ]);

         DB::table('medicos')->insert([
        'name'=>'med2',
        'lastName'=>'msss',
        'gender'=>'Masculino',
        'email'=>'eavcssssss@hotmail.com',
        'password'=>bcrypt('124578'),
        ]);

        DB::table('medicos')->insert([
       'name'=>'med3',
       'lastName'=>'msssxxxss',
       'gender'=>'Masculino',
       'email'=>'ezzzsssss@hotmail.com',
       'password'=>bcrypt('124578'),
       ]);


          DB::table('roles')->insert([
         'name'=>'patient',
         'display_name'=>'Paciente',
         'description'=>'User is allowed to manage and edit other users'
         ]);

         DB::table('roles')->insert([
        'name'=>'medico',
        'display_name'=>'Paciente',
        'description'=>'User is allowed to manage and edit other users'
        ]);

         DB::table('roles')->insert([
        'name'=>'admin',
        'display_name'=>'Administrador',
        'description'=>'User is allowed to manage and edit other users'
        ]);

        DB::table('roles')->insert([
       'name'=>'medical_center',
       'display_name'=>'Centro Medico',
       'description'=>'User is allowed to manage and edit other users'
       ]);

        DB::table('role_user')->insert([
       'user_id'=>1,
       'role_id'=>3,
       ]);


        DB::table('medical_centers')->insert([
       'name'=>'Otro',
       'emailAdmin'=>'No aplica',
        'nameAdmin'=>'No aplica',
         'phone'=>'No aplica',
         'city'=>'No aplica',
       ]);

       DB::table('medical_centers')->insert([
      'name'=>'Agustin',
      'emailAdmin'=>'Agustin',
       'nameAdmin'=>'No aplica',
        'phone'=>'No aplica',
        'city'=>'No aplica',
      ]);

      DB::table('medical_centers')->insert([
     'name'=>'Jose Gregorioies',
     'emailAdmin'=>'Agustin',
      'nameAdmin'=>'No aplica',
       'phone'=>'No aplica',
       'city'=>'No aplica',
     ]);

        DB::table('plans')->insert([
       'name'=>'Plan Basico',
       'applicable'=>'Medicos y Especialistas',
       'price1'=>0,
       'price2'=>0,
       'price3'=>0,

       ]);

        DB::table('plans')->insert([
       'name'=>'Plan Mi Agenda',
       'applicable'=>'Medicos y Especialistas',
       'price1'=>0,
       'price2'=>0,
       'price3'=>0,

       ]);


        DB::table('plans')->insert([
       'name'=>'Plan Profesional',
       'applicable'=>'Medicos y Especialistas',
       'price1'=>0,
       'price2'=>0,
       'price3'=>0,

       ]);

       DB::table('plans')->insert([
         'name'=>'Plan Platino',
         'applicable'=>'Medicos y Especialistas',
         'price1'=>0,
         'price2'=>0,
         'price3'=>0,

       ]);

       DB::table('plans')->insert([
      'name'=>'Plan Basico',
      'applicable'=>'Medicina Alternativa, Psicologos y Terapeutas',
      'price'=>0,
      ]);

       DB::table('plans')->insert([
         'name'=>'Plan Mi Agenda',
         'applicable'=>'Medicina Alternativa, Psicologos y Terapeutas',
         'price'=>0,
       ]);
       DB::table('plans')->insert([
      'name'=>'Plan Profesional',
      'applicable'=>'Medicina Alternativa, Psicologos y Terapeutas',
      'price'=>0,
      ]);


     DB::table('plans')->insert([
    'name'=>'Plan Platino',
    'applicable'=>'Medicina Alternativa, Psicologos y Terapeutas',
    'price'=>0,
    ]);


      DB::table('plans')->insert([
     'name'=>'Plan Basico',
     'applicable'=>'Nucleos Medicos',
     'price'=>0,
     ]);

      DB::table('plans')->insert([
     'name'=>'Plan Control',
     'applicable'=>'Nucleos Medicos',
     'price'=>0,
     ]);

         DB::table('plans')->insert([
        'name'=>'Plan Profesional-Plus',
        'applicable'=>'Nucleos Medicos',
        'price'=>0,
        ]);

        DB::table('plans')->insert([
       'name'=>'Plan Platino-Plus',
       'applicable'=>'Nucleos Medicos',
       'price'=>0,
       ]);



        DB::table('permissions')->insert([
       'name'=>'edit',
       'display_name'=>'Edit Users',
       'description'=>'edit existing users'
       ]);



      DB::table('permissions')->insert([
     'name'=>'Editar',
     'description'=>'Editar usuarios y planes',
     ]);

     DB::table('permissions')->insert([
    'name'=>'Eliminar',
    'description'=>'Eliminar usuarios y planes',
  ]);

    }
}
