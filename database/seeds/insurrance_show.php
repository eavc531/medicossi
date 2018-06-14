<?php

use Illuminate\Database\Seeder;

class insurrance_show extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('insurrance_shows')->insert([
        'name'=>'AXA',
      ]);

      DB::table('insurrance_shows')->insert([
     'name'=>'Met Life',
     ]);


       DB::table('insurrance_shows')->insert([
     'name'=>'Seguros monterrey',
     ]);

       DB::table('insurrance_shows')->insert([
      'name'=>'Gnp Grupo Provincial',
      ]);


      DB::table('insurrance_shows')->insert([
     'name'=>'Mapfre',
     ]);

     DB::table('insurrance_shows')->insert([
    'name'=>'Seguros Tepeyac',
    ]);

    DB::table('insurrance_shows')->insert([
   'name'=>'ING',
   ]);

   DB::table('insurrance_shows')->insert([
  'name'=>'Seguros Atlas',
          ]);

          DB::table('insurrance_shows')->insert([
         'name'=>'Alianz
        ',
         ]);

        DB::table('insurrance_shows')->insert([
        'name'=>'Zurich',
        ]);
    }
}
