<?php

use Illuminate\Database\Seeder;

class specialty_category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('specialty_categories')->insert([
        'name'=>'Medicos y Especialistas',
      ]);

      DB::table('specialty_categories')->insert([
     'name'=>'Dentistas',
     ]);


       DB::table('specialty_categories')->insert([
     'name'=>'Medicina Alternativa',
     ]);

       DB::table('specialty_categories')->insert([
      'name'=>'Terapeutas y Nutricion',
      ]);


    }
}
