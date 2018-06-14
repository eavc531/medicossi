<?php

use Illuminate\Database\Seeder;

class statesAndCities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('states')->insert([
     'name'=>'Aguascalientes ',
     ]);

     DB::table('states')->insert([
    'name'=>'Baja California',
    ]);

    DB::table('states')->insert([
   'name'=>'Baja California Sur',
   ]);

   DB::table('states')->insert([
  'name'=>'Campeche',
  ]);

  DB::table('states')->insert([
 'name'=>'Coahuila de Zaragoza',
 ]);

  //Cities//Cities//Cities//Cities//Cities//Cities//Cities//Cities//Cities

  DB::table('cities')->insert([
   'name'=>'Aguascalientes',
   'state_id'=>1,
 ]);


 DB::table('cities')->insert([
  'name'=>'Ensenada',
  'state_id'=>2,
]);

DB::table('cities')->insert([
 'name'=>'Mexicali',
 'state_id'=>2,
]);

DB::table('cities')->insert([
 'name'=>'Tijuana',
 'state_id'=>2,
]);

DB::table('cities')->insert([
 'name'=>'La Paz',
 'state_id'=>3,
]);

DB::table('cities')->insert([
 'name'=>'Los Cabos',
 'state_id'=>3,
]);

DB::table('cities')->insert([
 'name'=>'Campeche',
 'state_id'=>4,
]);

DB::table('cities')->insert([
 'name'=>'Ciudad del Carmen',
 'state_id'=>4,
]);

    }


}
