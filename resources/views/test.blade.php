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
            $table->string('Glucosa')->nullable();
            $table->string('Urea')->nullable();
            $table->string('Capacidad pulmonar total')->nullable();
            $table->string('Hemoglobina glucosilada')->nullable();
            $table->string('Aspartato aminotransferasa')->nullable();
            $table->string('Alanino aminotransfereasa')->nullable();
            $table->string('ARFI')->nullable();
            $table->string('Carga viral hepatitis C')->nullable();
            $table->string('Bilirrubina total')->nullable();
            $table->string('Bilirrubina directa')->nullable();
            $table->string('Bilirrubina indirecta')->nullable();
            $table->string('Hormona estimulante de tiroides')->nullable();
            $table->string('Colesterol total')->nullable();
            $table->string('Lp de alta densidad')->nullable();
            $table->string('Lp de baja densidad 1')->nullable();
            $table->string('Trigliceridos')->nullable();
            $table->string('Hemoglobina')->nullable();
            $table->string('Leucocitos')->nullable();
            $table->string('Plaquetas')->nullable();
            $table->string('Hierro en suero')->nullable();
            $table->string('Ácido fólico')->nullable();
            $table->string('Blastos')->nullable();
            $table->string('Gonadotrofina corionica beta')->nullable();
            $table->string('Estradiol')->nullable();
            $table->string('Progesterona')->nullable();
            $table->string('Antígeno Carcinoembronario')->nullable();
            $table->string('Alfa fetoproteina o Fetoproteina alfa 1')->nullable();
            $table->string('CA 15-3')->nullable();
            $table->string('Antígeno de cancer CA 19-9')->nullable();
            $table->string('ACTH')->nullable();
            $table->string('Transferrina')->nullable();
            $table->string('Fosfatasa alcalina osea')->nullable();
            $table->string('CA 125')->nullable();
            $table->string('Aldosterona')->nullable();
            $table->string('Hormona paratiroidea')->nullable();
            $table->string('Cortisol')->nullable();
            $table->string('Insulina')->nullable();
            $table->string('Hormona folículo estimulante')->nullable();
            $table->string('Hormona luteinizante')->nullable();
            $table->string('Prolactina')->nullable();
            $table->string('Testosterona')->nullable();
            $table->string('pH orina')->nullable();
            $table->string('Albúmina en orina')->nullable();
            $table->string('Volumen espiratorio de reserva')->nullable();
            $table->string('Cap.Difusión monóxido de carbono')->nullable();
            $table->string('Vol. espiratorio forzado en 1 segundo')->nullable();
            $table->string('Capácidad vital forzada')->nullable();
            $table->string('Capacidad residual funcional')->nullable();
            $table->string('Flujo espiratorio forzado de 25-75%')->nullable();
            $table->string('Ventilación voluntaria máxima')->nullable();
            $table->string('Flujo espiratorio máximo')->nullable();
            $table->string('Volumen residual')->nullable();
            $table->string('Fosfatasa Ácida')->nullable();
            $table->string('Capacidad vital lenta')->nullable();
            $table->string('Tiempo de sangrado')->nullable();
            $table->string('Tiempo de trombina')->nullable();
            $table->string('Tiempo de tromboplastina parcial')->nullable();
            $table->string('Fibrinógeno')->nullable();
            $table->string('Agregación plaquetaria con ADP')->nullable();
            $table->string('Agregación plaquetaria con Colágena')->nullable();
            $table->string('Agregación plaquetaria con Epinefrina')->nullable();
            $table->string('Agregación plaquetaria con Ristocetina')->nullable();
            $table->string('Vitamina B 12')->nullable();
            $table->string('Antígeno prostático')->nullable();
            $table->string('Homocisteina')->nullable();
            $table->string('Velocidad de sedimentación globular')->nullable();
            $table->string('Hematocrito')->nullable();
            $table->string('Proteína C reactiva')->nullable();
            $table->string('Tiempo de Protrombina')->nullable();
            $table->string('Neutrófilos')->nullable();
            $table->string('Creatinina')->nullable();
            $table->string('Concentración media de Hemoglobina')->nullable();
            $table->string('Linfocitos')->nullable();
            $table->string('Ácido úrico')->nullable();
            $table->string('Nitrógeno ureico')->nullable();
            $table->string('Lp de baja densidad 2')->nullable();
            $table->string('Fosfatasa alcalina')->nullable();
            $table->string('Creatin fosfoquinasa')->nullable();
            $table->string('Deshidrogenasa láctica')->nullable();
            $table->string('Fracción 3 del complemento')->nullable();
            $table->string('Cuenta corregida de reticulocitos')->nullable();
            $table->string('Fracción 4 del complemento')->nullable();
            $table->string('Factor Reumatoide')->nullable();
            $table->string('Anticuerpos antinucleares')->nullable();
            $table->string('Calcio en suero')->nullable();
            $table->string('Albúmina en suero')->nullable();
            $table->string('Anticuerpos antifosfolipido IgG')->nullable();
            $table->string('Beta 2 Glicoproteina 1')->nullable();
            $table->string('Anticuerpos antifosfolipido IgM')->nullable();
            $table->string('Dímero D')->nullable();
            $table->string('Anticuerpos vs. Péptidos citrulinados')-;>nullable();
            $table->string('T4 o tiroxina total')->nullable();
            $table->string('T3 o triyodotironina')->nullable();
            $table->string('Glutamiltranspeptidasa-gama')->nullable();
            $table->string('T4 o tiroxina libre')->nullable();
            $table->string('FibroScan')->nullable();
            $table->string('Albúmina en suero')->nullable();
            $table->string('Ac vs. Ag Superficie VHB')->nullable();
            $table->string('Antígeno e VHB')->nullable();
            $table->string('Ac vs. Ag. Central del VHB')->nullable();
            $table->string('Ferritina sérica')->nullable();
            $table->string('Anticuerpos vs Ag e VHB')->nullable();
            $table->string('Antígeno de cancer de Prostata-2')->nullable();
            $table->string('INR')->nullable();
            $table->string('Ácido Valproico')->nullable();
            $table->string('Amiba')->nullable();
            $table->string('Amilasa')->nullable();
            $table->string('Ac. Anti-Ag "c" DE LA HEPATITIS B IgG e IgM (Anti HBc)')->nullable();
            $table->string('Ac_Anti_cardiolipinas_IgG_e_IgM')->nullable();
            $table->string('Ac_Anti_Helicobacter_pylori_IgG')->nullable();
            $table->string('Ac_Anti_Hepatitis_A_IgG_e_IgM_Anti_HAV')->nullable();
            $table->string('Ac_Anti_Hepatitis_Anti_HCV')->nullable();
            $table->string('Ac_Anti_Herpes_I IgG e IgM y II IgG eIgM')->nullable();
            $table->string('Ac_Anti_HIV_I y II')->nullable();
            $table->string('Ac_Anti_Nucleares_(ANA)')->nullable();
            $table->string('Ac_Anti_Rubeola_IgG eIgM')->nullable();
            $table->string('Ac_Anti_Tiroide_(Ac. Tiroglobulina y Ac. Peroxidasa)')->nullable();
            $table->string('Ac_Anti_Toxoplasama_gondii.igG e eIgM')->nullable();
            $table->string('Alfafetoproteina')->nullable();
            $table->string('Anfetaminas en Orina')->nullable();
            $table->string('Atiestreptolisinas')->nullable();
            $table->string('Ag. Australia o superficie (HBs Ag)')->nullable();
            $table->string('Ag. CA-125 (Ovario)')->nullable();
            $table->string('Ag. CA-15.3 (Mama)')->nullable();
            $table->string('Ag. CA-19.9 (Páncreas)')->nullable();
            $table->string('Ag. Carcinoembrionario')->nullable();
            $table->string('Ag. Helicobacter Pylori en Heces')->nullable();
            $table->string('Ag. Prostático especifico Peroxidasa')->nullable();
            $table->string('Ag. Prostático especifico fraccion libre')->nullable();
            $table->string('Ag. Rotavirus')->nullable();
            $table->string('Biometria Hemática')->nullable();
            $table->string('Calcio')->nullable();
            $table->string('Canabinoides en Orina')->nullable();
            $table->string('Carbamazepina')->nullable();
            $table->string('Células L.E.')->nullable();
            $table->string('Cocaina en Orina')->nullable();
            $table->string('Colesterol total')->nullable();
            $table->string('Colesterol de alta densidad (HDL)')->nullable();
            $table->string('Colesterol de baja densidad (LDL)')->nullable();
            $table->string('Colesterol de muy baja densidad (VLDL)')->nullable();
            $table->string('Coprológico general')->nullable();
            $table->string('Coproparasitoscópico')->nullable();
            $table->string('Cortisol')->nullable();
            $table->string('Creatinina')->nullable();
            $table->string('Cultivo Bacteriológico')->nullable();
            $table->string('Depuración de Creatina en orina de 24 HttpResponse')->nullable();
            $table->string('Deshidrogenasa láctica (DHL)')->nullable();
            $table->string('DifenilHidantoina (Fenitoina)')->nullable();
            $table->string('Electroforesis de Lipoproteinas')->nullable();
            $table->string('Electrolitos (Na, K, CI)')->nullable();
            $table->string('Eosinófilos en modo nasal')->nullable();
            $table->string('Eritrosedimentación (VSG)')->nullable();
            $table->string('Espermatobioscopia')->nullable();
            $table->string('Fosfatasa Ácida fraccion prostática')->nullable();
            $table->string('Fósforo')->nullable();
            $table->string('Glucosa en ayuno')->nullable();
            $table->string('Glucosa 2 horas post-pandial')->nullable();
            $table->string('Glucosa tolerancia')->nullable();
            $table->string('Grupo sanguineo y Factor Rh')->nullable();
            $table->string('Hemoglobina glicosilada (HbA 1c)')->nullable();
            $table->string('Hierro Sérico')->nullable();
            $table->string('Inmonuglobulinas IgA, IgG e IgM')->nullable();
            $table->string('Inmunoglobulina IgE')->nullable();
            $table->string('Insulina')->nullable();
            $table->string('Lipasa')->nullable();
            $table->string('Lípidos totales')->nullable();
            $table->string('Magnesio')->nullable();
            $table->string('Microalbuminuria en orina 24h')->nullable();
            $table->string('Papanicolaou')->nullable();
            $table->string('Perfil de lipidos')->nullable();
            $table->string('Perfil ovárico')->nullable();
            $table->string('Perfil tiroideo')->nullable();
            $table->string('Progesterona')->nullable();
            $table->string('Prolactina')->nullable();
            $table->string('Proteína C reactiva')->nullable();
            $table->string('Proteína C reactiva ultrasensible')->nullable();
            $table->string('Proteínas totales con relación A/G')->nullable();
            $table->string('Proteínas en orina de 24h')->nullable();
            $table->string('Quimica sanguinea de 4 elementos')->nullable();
            $table->string('Reacciones fecriles')->nullable();
            $table->string('Reticulocitos')->nullable();
            $table->string('Sangre Oculta en heces')->nullable();
            $table->string('Sub-unidad Beta (CUALITATIVA)')->nullable();
            $table->string('Sub-unidad Beta (CUANTITATIVA)')->nullable();
            $table->string('Testosterona Libre, Total y Biodisponible')->nullable();
            $table->string('Testosterona Total')->nullable();
            $table->string('Tiempo de Protrombina')->nullable();
            $table->string('T.G.O. (AST)')->nullable();
            $table->string('T.G.P. (ALT)')->nullable();
            $table->string('T3 libre')->nullable();
            $table->string('T4 Libre')->nullable();
            $table->string('Tropomina')->nullable();
            $table->string('UreaUrianálisis')->nullable();
            $table->string('V.D.R.l')->nullable();
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


$vital_sign['Altura'] = $request['Altura'];
$vital_sign['Altura show'] = $request['Altura show'];
$vital_sign['Peso'] = $request['Peso'];
$vital_sign['Peso show'] = $request['Peso show'];
$vital_sign['Tensión Arterial'] = $request['Tensión Arterial'];
$vital_sign['Tensión Arterial show' ] = $request['Tensión Arterial show'];
$vital_sign['Temperatura Corporal'] = $request['Temperatura Corporal'];
$vital_sign['Temperatura Corporal show' ] = $request['Temperatura Corporal show'];
$vital_sign['Frecuencia Cardíaca'] = $request['Frecuencia Cardíaca'];
$vital_sign['Frecuencia Cardíaca show'] = $request['Frecuencia Cardíaca show'];
$vital_sign['Frecuencia Respiratoria'] = $request['Frecuencia Respiratoria'];
$vital_sign['Frecuencia Respiratoria show' ] = $request['Frecuencia Respiratoria show'];
$vital_sign['Oxigenación'] = $request[''];
$vital_sign['Oxigenación show'] = $request[''];
$vital_sign['Índice de Masa Corporal'] = $request[''];
$vital_sign['Índice de Masa Corporal show'] = $request[''];
$vital_sign['Porcentaje de Grasa Corporal'] = $request[''];
$vital_sign['Porcentaje de Grasa Corporal show'] = $request[''];
$vital_sign['Índice de Masa Muscular'] = $request[''];
$vital_sign['Índice de Masa Muscular show'] = $request[''];
$vital_sign['Cintura'] = $request[''];
$vital_sign['Cintura show'] = $request[''];
$vital_sign['Cadera'] = $request[''];
$vital_sign['Cadera show'] = $request[''];
$vital_sign['Perímetro Cefálico' ] = $request[''];
$vital_sign['Perímetro Cefálico show'] = $request[''];
