<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabsTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('note_id')->unsigned()->nullable();
            $table->foreign('note_id')->references('id')->on('notes');
            $table->integer('medico_id')->unsigned()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos');

            $table->string('Glucosa')->nullable();
            $table->string('Urea')->nullable();
            $table->string('Capacidad_pulmonar_total')->nullable();
            $table->string('Hemoglobina_glucosilada')->nullable();
            $table->string('Aspartato_aminotransferasa')->nullable();
            $table->string('Alanino_aminotransfereasa')->nullable();
            $table->string('ARFI')->nullable();
            $table->string('Carga_viral_hepatitis_C')->nullable();
            $table->string('Bilirrubina_total')->nullable();
            $table->string('Bilirrubina_directa')->nullable();
            $table->string('Bilirrubina_indirecta')->nullable();
            $table->string('Hormona_estimulante_de_tiroides')->nullable();
            $table->string('Colesterol_total')->nullable();
            $table->string('Lp_de_alta_densidad')->nullable();
            $table->string('Lp_de_baja_densidad_1')->nullable();
            $table->string('Trigliceridos')->nullable();
            $table->string('Hemoglobina')->nullable();
            $table->string('Leucocitos')->nullable();
            $table->string('Plaquetas')->nullable();
            $table->string('Hierro_en_suero')->nullable();
            $table->string('Ácido_fólico')->nullable();
            $table->string('Blastos')->nullable();
            $table->string('Gonadotrofina_corionica_beta')->nullable();
            $table->string('Estradiol')->nullable();
            $table->string('Progesterona')->nullable();
            $table->string('Antígeno_Carcinoembronario')->nullable();
            $table->string('Alfa_fetoproteina_o_Fetoproteina_alfa_1')->nullable();
            $table->string('CA_15_3')->nullable();
            $table->string('Antígeno_de_cancer_CA_19_9')->nullable();
            $table->string('ACTH')->nullable();
            $table->string('Transferrina')->nullable();
            $table->string('Fosfatasa_alcalina_osea')->nullable();
            $table->string('CA_125')->nullable();
            $table->string('Aldosterona')->nullable();
            $table->string('Hormona_paratiroidea')->nullable();
            $table->string('Cortisol')->nullable();
            $table->string('Insulina')->nullable();
            $table->string('Hormona_folículo_estimulante')->nullable();
            $table->string('Hormona_luteinizante')->nullable();
            $table->string('Prolactina')->nullable();
            $table->string('Testosterona')->nullable();
            $table->string('pH_orina')->nullable();
            $table->string('Albúmina_en_orina')->nullable();
            $table->string('Volumen_espiratorio_de_reserva')->nullable();
            $table->string('Cap.Difusión_monóxido_de_carbono')->nullable();
            $table->string('Vol._espiratorio_forzado_en_1_segundo')->nullable();
            $table->string('Capácidad_vital_forzada')->nullable();
            $table->string('Capacidad_residual_funcional')->nullable();
            $table->string('Flujo_espiratorio_forzado_de_25_7')->nullable();
            $table->string('Ventilación_voluntaria_máxima')->nullable();
            $table->string('Flujo _spiratorio_máximo')->nullable();
            $table->string('Volumen_residual')->nullable();
            $table->string('Fosfatasa_Ácida')->nullable();
            $table->string('Capacidad_vital_lenta')->nullable();
            $table->string('Tiempo_de_sangrado')->nullable();
            $table->string('Tiempo_de_trombina')->nullable();
            $table->string('Tiempo_de_tromboplastina parcial')->nullable();
            $table->string('Fibrinógeno')->nullable();
            $table->string('Agregación_plaquetaria_con_ADP')->nullable();
            $table->string('Agregación_plaquetaria_con_Colágena')->nullable();
            $table->string('Agregación_plaquetaria_con_Epinefrina')->nullable();
            $table->string('Agregación_plaquetaria_con_Ristocetina')->nullable();
            $table->string('Vitamina_B_12')->nullable();
            $table->string('Antígeno_prostático')->nullable();
            $table->string('Homocisteina')->nullable();
            $table->string('Velocidad_de_sedimentación_globular')->nullable();
            $table->string('Hematocrito')->nullable();
            $table->string('Proteína_C_reactiva')->nullable();
            $table->string('Tiempo_de_Protrombina')->nullable();
            $table->string('Neutrófilos')->nullable();
            $table->string('Creatinina')->nullable();
            $table->string('Concentración_media_de_Hemoglobina')->nullable();
            $table->string('Linfocitos')->nullable();
            $table->string('Ácido_úrico')->nullable();
            $table->string('Nitrógeno_ureico')->nullable();
            $table->string('Lp_de_baja_densidad_2')->nullable();
            $table->string('Fosfatasa alcalina')->nullable();
            $table->string('Creatin_fosfoquinasa')->nullable();
            $table->string('Deshidrogenasa_láctica')->nullable();
            $table->string('Fracción_3_del_complemento')->nullable();
            $table->string('Cuenta_corregida_de_reticulocitos')->nullable();
            $table->string('Fracción_4_del_complemento')->nullable();
            $table->string('Factor_Reumatoide')->nullable();
            $table->string('Anticuerpos_antinucleares')->nullable();
            $table->string('Calcio_en_suero')->nullable();
            $table->string('Albúmina_en_suero')->nullable();
            $table->string('Anticuerpos_antifosfolipido_IgG')->nullable();
            $table->string('Beta_2_Glicoproteina_1')->nullable();
            $table->string('Anticuerpos_antifosfolipido_IgM')->nullable();
            $table->string('Dímero_D')->nullable();
            $table->string('Anticuerpos_vs_Péptidos_citrulinados')->nullable();
            $table->string('T4_o_tiroxina_total')->nullable();
            $table->string('T3_o_triyodotironina')->nullable();
            $table->string('Glutamiltranspeptidasa_gama')->nullable();
            $table->string('T4_o_tiroxina_libre')->nullable();
            $table->string('FibroScan')->nullable();
            $table->string('Albúmina_en_suero')->nullable();
            $table->string('Ac_vs_Ag_Superficie_VHB')->nullable();
            $table->string('Antígeno_e_VHB')->nullable();
            $table->string('Ac_vs_Ag_Central_del_VHB')->nullable();
            $table->string('Ferritina_sérica')->nullable();
            $table->string('Anticuerpos_vs_Ag_e_VHB')->nullable();
            $table->string('Antígeno_de_cancer_de_Prostata-2')->nullable();
            $table->string('INR')->nullable();
            $table->string('Ácido_Valproico')->nullable();
            $table->string('Amiba')->nullable();
            $table->string('Amilasa')->nullable();
            // $table->string('Ac. Anti-Ag "c" DE LA HEPATITIS B IgG e IgM Anti HBc')->nullable();
            // $table->string('Ac_Anti_cardiolipinas_IgG_e_IgM')->nullable();
            // $table->string('Ac_Anti_Helicobacter_pylori_IgG')->nullable();
            // $table->string('Ac_Anti_Hepatitis_A_IgG_e_IgM_Anti_HAV')->nullable();
            // $table->string('Ac_Anti_Hepatitis_Anti_HCV')->nullable();
            // $table->string('Ac_Anti_Herpes_I IgG e IgM y II IgG eIgM')->nullable();
            // $table->string('Ac_Anti_HIV_I y II')->nullable();
            // $table->string('Ac_Anti_Nucleares_ANA')->nullable();
            // $table->string('Ac_Anti_Rubeola_IgG eIgM')->nullable();
            // $table->string('Ac_Anti_Tiroide_Ac. Tiroglobulina y Ac. Peroxidasa)')->nullable();
            // $table->string('Ac_Anti_Toxoplasama_gondii.igG e eIgM')->nullable();
            // $table->string('Alfafetoproteina')->nullable();
            // $table->string('Anfetaminas en Orina')->nullable();
            // $table->string('Atiestreptolisinas')->nullable();
            // $table->string('Ag. Australia o superficie (HBs Ag)')->nullable();
            // $table->string('Ag. CA-125 Ovario')->nullable();
            // $table->string('Ag. CA-15.3 Mama')->nullable();
            // $table->string('Ag. CA-19.9 Páncreas')->nullable();
            // $table->string('Ag. Carcinoembrionario')->nullable();
            // $table->string('Ag. Helicobacter Pylori en Heces')->nullable();
            // $table->string('Ag. Prostático especifico Peroxidasa')->nullable();
            // $table->string('Ag. Prostático especifico fraccion libre')->nullable();
            // $table->string('Ag. Rotavirus')->nullable();
            // $table->string('Biometria Hemática')->nullable();
            // $table->string('Calcio')->nullable();
            // $table->string('Canabinoides en Orina')->nullable();
            // $table->string('Carbamazepina')->nullable();
            // $table->string('Células L E')->nullable();
            // $table->string('Cocaina en Orina')->nullable();
            // $table->string('Colesterol total')->nullable();
            // $table->string('Colesterol de alta densidad (HDL)')->nullable();
            // $table->string('Colesterol de baja densidad (LDL)')->nullable();
            // $table->string('Colesterol de muy baja densidad (VLDL)')->nullable();
            // $table->string('Coprológico general')->nullable();
            // $table->string('Coproparasitoscópico')->nullable();
            // $table->string('Cortisol')->nullable();
            // $table->string('Creatinina')->nullable();
            // $table->string('Cultivo Bacteriológico')->nullable();
            // $table->string('Depuración de Creatina en orina de 24 HttpResponse')->nullable();
            // $table->string('Deshidrogenasa láctica DHL')->nullable();
            // $table->string('DifenilHidantoina Fenitoina')->nullable();
            // $table->string('Electroforesis de Lipoproteinas')->nullable();
            // // $table->string('Electrolitos (Na, K, CI)')->nullable();
            // $table->string('Eosinófilos en modo nasal')->nullable();
            // $table->string('Eritrosedimentación (VSG)')->nullable();
            // $table->string('Espermatobioscopia')->nullable();
            // $table->string('Fosfatasa Ácida fraccion prostática')->nullable();
            // $table->string('Fósforo')->nullable();
            // $table->string('Glucosa en ayuno')->nullable();
            // $table->string('Glucosa 2 horas post-pandial')->nullable();
            // $table->string('Glucosa tolerancia')->nullable();
            // $table->string('Grupo sanguineo y Factor Rh')->nullable();
            // $table->string('Hemoglobina glicosilada (HbA 1c)')->nullable();
            // $table->string('Hierro Sérico')->nullable();
            // $table->string('Inmonuglobulinas IgA, IgG e IgM')->nullable();
            // $table->string('Inmunoglobulina IgE')->nullable();
            // $table->string('Insulina')->nullable();
            // $table->string('Lipasa')->nullable();
            // $table->string('Lípidos totales')->nullable();
            // $table->string('Magnesio')->nullable();
            // $table->string('Microalbuminuria en orina 24h')->nullable();
            // $table->string('Papanicolaou')->nullable();
            // $table->string('Perfil de lipidos')->nullable();
            // $table->string('Perfil ovárico')->nullable();
            // $table->string('Perfil tiroideo')->nullable();
            // $table->string('Progesterona')->nullable();
            // $table->string('Prolactina')->nullable();
            // $table->string('Proteína C reactiva')->nullable();
            // $table->string('Proteína C reactiva ultrasensible')->nullable();
            // $table->string('Proteínas totales con relación A/G')->nullable();
            // $table->string('Proteínas en orina de 24h')->nullable();
            // $table->string('Quimica sanguinea de 4 elementos')->nullable();
            // $table->string('Reacciones fecriles')->nullable();
            // $table->string('Reticulocitos')->nullable();
            // $table->string('Sangre Oculta en heces')->nullable();
            // $table->string('Sub-unidad Beta (CUALITATIVA)')->nullable();
            // $table->string('Sub-unidad Beta (CUANTITATIVA)')->nullable();
            // $table->string('Testosterona Libre, Total y Biodisponible')->nullable();
            // $table->string('Testosterona Total')->nullable();
            // $table->string('Tiempo de Protrombina')->nullable();
            // $table->string('T.G.O. (AST)')->nullable();
            // $table->string('T.G.P. (ALT)')->nullable();
            // $table->string('T3 libre')->nullable();
            // $table->string('T4 Libre')->nullable();
            // $table->string('Tropomina')->nullable();
            // $table->string('UreaUrianálisis')->nullable();
            // $table->string('V.D.R.l')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labs_tests');
    }
}
