<?php

use Illuminate\Database\Seeder;

class note_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('notes')->insert([
        'title'=>'Nota Médica Inicial',
        'type'=>'default',
        'Signos_vitales'=>'<ul>
	<li><strong>Altura:</strong></li>
	<li><strong>Peso:</strong></li>
	<li><strong>Temperatura:</strong></li>
	<li><strong>Frecuencia Cardiaca:</strong></li>
	<li><strong>Freucuencia Respiratoria:</strong></li>
	<li><strong>Oxigenacion:</strong></li>
	<li><strong>Indice de Masa Corporal:</strong></li>
	<li><strong>Peremietro Cefalico:</strong></li>
	<li><strong>Porcentaje de Grasa Corporal:</strong></li>
	<li><strong>indice de Masa Muscular:</strong></li>
	<li><strong>Cintura:</strong></li>
	<li><strong>Cadera:</strong></li>
	<li><strong>Pierna:</strong></li>
	<li><strong>Brazo:</strong></li>
</ul>',

  'Pruebas_de_laboratorio'=>'<ul>
	<li><strong>Acido urico:</strong></li>
	<li><strong>creatina:</strong></li>
	<li><strong>Colesterol:</strong></li>
	<li><strong>Insulina:</strong></li>
	<li><strong>Grucosa en Ayuno:</strong></li>
	<li><strong>Calcio:</strong></li>
	<li><strong>Urofrafia escretora:</strong></li>
	<li><strong>Quimica Sanguinea:</strong></li>
	<li><strong>Trigliseridos:</strong></li>
	<li><strong>Indice de Masa Muscular:</strong></li>
	<li><strong>Biometria epatica:</strong></li>
	<li><strong>Papanicolao:</strong></li>
</ul>'

      ]);

      DB::table('notes')->insert([
        'title'=>'Nota Médica de Evolucion',
        'type'=>'default',
        'Signos_vitales'=>'<ul>
  <li><strong>Altura:</strong></li>
  <li><strong>Peso:</strong></li>
  <li><strong>Temperatura:</strong></li>
  <li><strong>Frecuencia Cardiaca:</strong></li>
  <li><strong>Freucuencia Respiratoria:</strong></li>
  <li><strong>Oxigenacion:</strong></li>
  <li><strong>Indice de Masa Corporal:</strong></li>
  <li><strong>Peremietro Cefalico:</strong></li>
  <li><strong>Porcentaje de Grasa Corporal:</strong></li>
  <li><strong>indice de Masa Muscular:</strong></li>
  <li><strong>Cintura:</strong></li>
  <li><strong>Cadera:</strong></li>
  <li><strong>Pierna:</strong></li>
  <li><strong>Brazo:</strong></li>
</ul>',

  'Pruebas_de_laboratorio'=>'<ul>
  <li><strong>Acido urico:</strong></li>
  <li><strong>creatina:</strong></li>
  <li><strong>Colesterol:</strong></li>
  <li><strong>Insulina:</strong></li>
  <li><strong>Grucosa en Ayuno:</strong></li>
  <li><strong>Calcio:</strong></li>
  <li><strong>Urofrafia escretora:</strong></li>
  <li><strong>Quimica Sanguinea:</strong></li>
  <li><strong>Trigliseridos:</strong></li>
  <li><strong>Indice de Masa Muscular:</strong></li>
  <li><strong>Biometria epatica:</strong></li>
  <li><strong>Papanicolao:</strong></li>
</ul>'

      ]);

      DB::table('notes')->insert([
        'title'=>'Nota de Interconsulta',
        'type'=>'default',
        'Signos_vitales'=>'<ul>
  <li><strong>Altura:</strong></li>
  <li><strong>Peso:</strong></li>
  <li><strong>Temperatura:</strong></li>
  <li><strong>Frecuencia Cardiaca:</strong></li>
  <li><strong>Freucuencia Respiratoria:</strong></li>
  <li><strong>Oxigenacion:</strong></li>
  <li><strong>Indice de Masa Corporal:</strong></li>
  <li><strong>Peremietro Cefalico:</strong></li>
  <li><strong>Porcentaje de Grasa Corporal:</strong></li>
  <li><strong>indice de Masa Muscular:</strong></li>
  <li><strong>Cintura:</strong></li>
  <li><strong>Cadera:</strong></li>
  <li><strong>Pierna:</strong></li>
  <li><strong>Brazo:</strong></li>
</ul>',

  'Pruebas_de_laboratorio'=>'<ul>
  <li><strong>Acido urico:</strong></li>
  <li><strong>creatina:</strong></li>
  <li><strong>Colesterol:</strong></li>
  <li><strong>Insulina:</strong></li>
  <li><strong>Grucosa en Ayuno:</strong></li>
  <li><strong>Calcio:</strong></li>
  <li><strong>Urofrafia escretora:</strong></li>
  <li><strong>Quimica Sanguinea:</strong></li>
  <li><strong>Trigliseridos:</strong></li>
  <li><strong>Indice de Masa Muscular:</strong></li>
  <li><strong>Biometria epatica:</strong></li>
  <li><strong>Papanicolao:</strong></li>
</ul>'

      ]);


      DB::table('notes')->insert([
        'title'=>'Nota médica de Urgencias',
        'type'=>'default',
        'Signos_vitales'=>'<ul>
  <li><strong>Altura:</strong></li>
  <li><strong>Peso:</strong></li>
  <li><strong>Temperatura:</strong></li>
  <li><strong>Frecuencia Cardiaca:</strong></li>
  <li><strong>Freucuencia Respiratoria:</strong></li>
  <li><strong>Oxigenacion:</strong></li>
  <li><strong>Indice de Masa Corporal:</strong></li>
  <li><strong>Peremietro Cefalico:</strong></li>
  <li><strong>Porcentaje de Grasa Corporal:</strong></li>
  <li><strong>indice de Masa Muscular:</strong></li>
  <li><strong>Cintura:</strong></li>
  <li><strong>Cadera:</strong></li>
  <li><strong>Pierna:</strong></li>
  <li><strong>Brazo:</strong></li>
</ul>',

  'Pruebas_de_laboratorio'=>'<ul>
  <li><strong>Acido urico:</strong></li>
  <li><strong>creatina:</strong></li>
  <li><strong>Colesterol:</strong></li>
  <li><strong>Insulina:</strong></li>
  <li><strong>Grucosa en Ayuno:</strong></li>
  <li><strong>Calcio:</strong></li>
  <li><strong>Urofrafia escretora:</strong></li>
  <li><strong>Quimica Sanguinea:</strong></li>
  <li><strong>Trigliseridos:</strong></li>
  <li><strong>Indice de Masa Muscular:</strong></li>
  <li><strong>Biometria epatica:</strong></li>
  <li><strong>Papanicolao:</strong></li>
</ul>'

      ]);


      DB::table('notes')->insert([
        'title'=>'Nota médica de Egreso',
        'type'=>'default',
        'Signos_vitales'=>'<ul>
  <li><strong>Altura:</strong></li>
  <li><strong>Peso:</strong></li>
  <li><strong>Temperatura:</strong></li>
  <li><strong>Frecuencia Cardiaca:</strong></li>
  <li><strong>Freucuencia Respiratoria:</strong></li>
  <li><strong>Oxigenacion:</strong></li>
  <li><strong>Indice de Masa Corporal:</strong></li>
  <li><strong>Peremietro Cefalico:</strong></li>
  <li><strong>Porcentaje de Grasa Corporal:</strong></li>
  <li><strong>indice de Masa Muscular:</strong></li>
  <li><strong>Cintura:</strong></li>
  <li><strong>Cadera:</strong></li>
  <li><strong>Pierna:</strong></li>
  <li><strong>Brazo:</strong></li>
</ul>',

  'Pruebas_de_laboratorio'=>'<ul>
  <li><strong>Acido urico:</strong></li>
  <li><strong>creatina:</strong></li>
  <li><strong>Colesterol:</strong></li>
  <li><strong>Insulina:</strong></li>
  <li><strong>Grucosa en Ayuno:</strong></li>
  <li><strong>Calcio:</strong></li>
  <li><strong>Urofrafia escretora:</strong></li>
  <li><strong>Quimica Sanguinea:</strong></li>
  <li><strong>Trigliseridos:</strong></li>
  <li><strong>Indice de Masa Muscular:</strong></li>
  <li><strong>Biometria epatica:</strong></li>
  <li><strong>Papanicolao:</strong></li>
</ul>'

      ]);

      DB::table('notes')->insert([
        'title'=>'Nota de Referencia o traslado',
        'type'=>'default',
        'Signos_vitales'=>'<ul>
  <li><strong>Altura:</strong></li>
  <li><strong>Peso:</strong></li>
  <li><strong>Temperatura:</strong></li>
  <li><strong>Frecuencia Cardiaca:</strong></li>
  <li><strong>Freucuencia Respiratoria:</strong></li>
  <li><strong>Oxigenacion:</strong></li>
  <li><strong>Indice de Masa Corporal:</strong></li>
  <li><strong>Peremietro Cefalico:</strong></li>
  <li><strong>Porcentaje de Grasa Corporal:</strong></li>
  <li><strong>indice de Masa Muscular:</strong></li>
  <li><strong>Cintura:</strong></li>
  <li><strong>Cadera:</strong></li>
  <li><strong>Pierna:</strong></li>
  <li><strong>Brazo:</strong></li>
</ul>',

  'Pruebas_de_laboratorio'=>'<ul>
  <li><strong>Acido urico:</strong></li>
  <li><strong>creatina:</strong></li>
  <li><strong>Colesterol:</strong></li>
  <li><strong>Insulina:</strong></li>
  <li><strong>Grucosa en Ayuno:</strong></li>
  <li><strong>Calcio:</strong></li>
  <li><strong>Urofrafia escretora:</strong></li>
  <li><strong>Quimica Sanguinea:</strong></li>
  <li><strong>Trigliseridos:</strong></li>
  <li><strong>Indice de Masa Muscular:</strong></li>
  <li><strong>Biometria epatica:</strong></li>
  <li><strong>Papanicolao:</strong></li>
</ul>'

      ]);
    }
}
