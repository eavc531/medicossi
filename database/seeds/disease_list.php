<?php

use Illuminate\Database\Seeder;

class disease_list extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {


        DB::table('disease_lists')->insert([
            'name'=>'Cólera',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Colera debido a vibrio cholerae o1, biotipo cholerae',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Colera debido a vibrio cholerae o1, biotipo el tor',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Colera no especificado',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Fiebres tifoidea y paratifoidea',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Fiebre tifoidea',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Fiebre paratifoidea a',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Fiebre paratifoidea b',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Fiebre paratifoidea c',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Fiebre paratifoidea, no especificada',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Otras infecciones debidas a Salmonella',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Enteritis debida a salmonella',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Septicemia debida a salmonella',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Infecciones localizadas debida a salmonella',
        ]);
        DB::table('disease_lists')->insert([
            'name'=>'Otras infecciones especificadas como debidas a salmonella',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion debida a salmonella no especificada',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Shigelosis',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Shigelosis debida a shigella dysenteriae',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Shigelosis debida a shigella flexneri',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Shigelosis debida a shigella boydii',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Shigelosis debida a shigella sonnei',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras shigelosis',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Shigelosis de tipo no especificado',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras infecciones intestinales bacterianas',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion debida a escherichia coli enteropatogena',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion debida a escherichia coli enterotoxigena',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion debida a escherichia coli enteroinvasiva',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion debida a escherichia coli enterohemorragica',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras infecciones intestinales debidas a escherichia coli',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Enteritis debida a campylobacter',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Enteritis debida a yersinia enterocolitica',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Enterocolitis debida a clostridium difficile',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras infecciones intestinales bacterianas especificadas',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion intestinal bacteriana, no especificada',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras intoxicaciones alimentarias bacterias',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Intoxicacion alimentaria estafilococica',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Botulismo',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Intoxicacion alimentaria debida a clostridium perfringens [clostridium welchii]',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Intoxicacion alimentaria debida a vibrio parahaemolyticus',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Intoxicacion alimentaria debida a bacillus cereus',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras intoxicaciones alimentarias debidas a bacterias especificadas',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Intoxicacion alimentaria bacteriana, no especificada',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Amebiasis',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Disenteria amebiana aguda',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Amebiasis intestinal cronica',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Colitis amebiana no disenterica',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Ameboma intestinal',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Absceso amebiano del higado',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Absceso amebiano del pulmon (j99.8)',
        ]);


        DB::table('disease_lists')->insert([
            'name'=>'Absceso amebiano del cerebro (g07)',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Amebiasis cutanea',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion amebiana de otras localizaciones',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Amebiasis, no especificada',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras enfermedades intestinales debidas a protozoarios',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Balantidiasis',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Giardiasis [lambliasis]',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Criptosporidiosis',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Isosporiasis',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras enfermedades intestinales especificadas debidas a protozoarios',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Enfermedad intestinal debida a protozoarios, no especificada',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infecciones intestinales debidas a virus y otros organismos especificados',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Enteritis debida a rotavirus',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Gastroenteropatia aguda debida al agente de norwalk',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Enteritis debida a adenovirus',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Otras enteritis virales',
        ]);

        DB::table('disease_lists')->insert([
            'name'=>'Infeccion intestinal viral, sin otra especificacion',
        ]);


    }
}
