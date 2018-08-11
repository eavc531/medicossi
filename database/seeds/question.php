<?php

use Illuminate\Database\Seeder;

class question extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vital_signs')->insert([
            'name_question'=>'Altura',
          'question'=>'Altura',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Peso',
          'question'=>'Peso',
          'show'=>'on',
        ]);


        DB::table('vital_signs')->insert([
            'name_question'=>'Tensión Arterial',
          'question'=>'Tensión_Arterial',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Temperatura Corporal',
          'question'=>'Temperatura_Corporal',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Frecuencia Cardíaca',
          'question'=>'Frecuencia_Cardíaca',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Frecuencia Respiratoria',
          'question'=>'Frecuencia_Respiratoria',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Oxigenación',
          'question'=>'Oxigenación',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Índice de Masa Corporal',
          'question'=>'Índice_de_Masa_Corporal',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Porcentaje de Grasa Corporal',
          'question'=>'Porcentaje_de_Grasa_Corporal',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Índice de Masa Muscular',
          'question'=>'Índice_de_Masa_Muscular',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Cintura',
          'question'=>'Cintura',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Cadera',
          'question'=>'Cadera',
          'show'=>'on',
        ]);

        DB::table('vital_signs')->insert([
            'name_question'=>'Perímetro Cefálico',
          'question'=>'Perímetro_Cefálico',
          'show'=>'on',
        ]);

        DB::table('test_labs')->insert([
            'name_question'=>'glucosa',
          'question'=>'glucosa',
          'show'=>'on',
        ]);

        DB::table('test_labs')->insert([
            'name_question'=>'Urea',
          'question'=>'Urea',
          'show'=>'on',
        ]);

        DB::table('test_labs')->insert([
         'name_question'=>'Capacidad pulmonar total',
          'question'=>'Capacidad_pulmonar_total',
          'show'=>'on',
        ]);
    }
}
