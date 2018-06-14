<?php

use Illuminate\Database\Seeder;

class specialty extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('specialties')->insert([
     'name'=>'Medico General',
     'specialty_category_id'=>1,
     ]);

     DB::table('specialties')->insert([
    'name'=>'Alergólogos',
    'specialty_category_id'=>1,
    ]);

    DB::table('specialties')->insert([
   'name'=>'Algólogos',
   'specialty_category_id'=>1,
   ]);

   DB::table('specialties')->insert([
  'name'=>'Anatomopatólogos',
  'specialty_category_id'=>1,
  ]);

  DB::table('specialties')->insert([
 'name'=>'Anestesiólogos',
 'specialty_category_id'=>1,
 ]);


 DB::table('specialties')->insert([
'name'=>'Angiólogos',
'specialty_category_id'=>1,
]);


DB::table('specialties')->insert([
'name'=>'Audiólogos',
'specialty_category_id'=>1,
]);


DB::table('specialties')->insert([
'name'=>'Cardiólogos',
'specialty_category_id'=>1,
]);


DB::table('specialties')->insert([
'name'=>'Cirujanos Generales',
'specialty_category_id'=>1,
]);


DB::table('specialties')->insert([
'name'=>'Cirujanos plásticos',
'specialty_category_id'=>1,
]);


DB::table('specialties')->insert([
'name'=>'Dentista General',
'specialty_category_id'=>2,
]);

DB::table('specialties')->insert([
'name'=>'Maxilofacial',
'specialty_category_id'=>2,
]);

DB::table('specialties')->insert([
'name'=>'Dentista Pediatrico',
'specialty_category_id'=>2,
]);

DB::table('specialties')->insert([
'name'=>'Endodoncista',
'specialty_category_id'=>2,
]);

DB::table('specialties')->insert([
'name'=>'Ortodoncista',
'specialty_category_id'=>2,
]);


DB::table('specialties')->insert([
'name'=>'Homeopatia',
'specialty_category_id'=>3,
]);

DB::table('specialties')->insert([
'name'=>'Flores de Bach',
'specialty_category_id'=>3,
]);

DB::table('specialties')->insert([
'name'=>'Naturista',
'specialty_category_id'=>3,
]);

DB::table('specialties')->insert([
'name'=>'Yoga',
'specialty_category_id'=>3,
]);

DB::table('specialties')->insert([
'name'=>'Reiki',
'specialty_category_id'=>3,
]);

DB::table('specialties')->insert([
'name'=>'Terapia Magnetica',
'specialty_category_id'=>3,
]);



DB::table('specialties')->insert([
'name'=>'Nutriologos',
'specialty_category_id'=>4,
]);

DB::table('specialties')->insert([
'name'=>'Psicologos',
'specialty_category_id'=>4,
]);

DB::table('specialties')->insert([
'name'=>'Masagista',
'specialty_category_id'=>4,
]);

DB::table('specialties')->insert([
'name'=>'Acupunturistas',
'specialty_category_id'=>4,
]);

DB::table('specialties')->insert([
'name'=>'Sexologos',
'specialty_category_id'=>4,
]);

  }
}
