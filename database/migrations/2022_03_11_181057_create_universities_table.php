<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('siglas')->nullable();
            $table->char('country', 2)->nullable();
            $table->boolean('private')->default(false);
            $table->char('department_id',2)->nullable();
            $table->char('province_id',4)->nullable();
            $table->char('district_id',6)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('country')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
        });

        
        DB::table('universities')->insert([
            ///desde aca nacionales
            ['name' => 'Universidad Nacional Mayor de San Marcos','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de San Cristóbal de Huamanga','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de San Antonio Abad del Cusco','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de Trujillo','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de San Agustín de Arequipa','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de Ingeniería','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional Agraria La Molina','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional San Luis Gonzaga','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional del Centro del Perú','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de la Amazonía Peruana','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional del Altiplano','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de Piura','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de Cajamarca','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional Federico Villarreal','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional Agraria de la Selva','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional Hermilio Valdizán de Huánuco','country'=>'PE','private'=>false],
            ['name' => 'Universidad Nacional de Educación Enrique Guzmán y Valle','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Daniel Alcides Carrión','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional del Callao','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional José Faustino Sánchez Carrión','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Pedro Ruiz Gallo','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Jorge Basadre Grohmann','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Santiago Antúnez de Mayolo','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de San Martín','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Ucayali','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Tumbes','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional del Santa','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Huancavelica','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Amazónica de Madre de Dios','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Toribio Rodríguez de Mendoza de Amazonas','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Micaela Bastidas de Apurímac','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Intercultural de la Amazonía','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Tecnológica de Lima Sur (*1)','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional José María Arguedas','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Moquegua','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Juliaca','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Jaén','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Frontera','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Autónoma de Chota','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Barranca','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional de Cañete','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Intercultural Fabiola Salazar Leguía de Bagua','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Intercultural de la Selva Central Juan Santos Atahualpa','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Intercultural de Quillabamba','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Autónoma de Alto Amazonas','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Autónoma Altoandina de Tarma','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Autónoma de Huanta','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Tecnológica de San Juan de Lurigancho','country' => 'PE','private' => false],
            ['name' => 'Universidad Autónoma Municipal de Los Olivos','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Autónoma de Tayacaja Daniel Hernández Morillo','country' => 'PE','private' => false],
            ['name' => 'Universidad Nacional Ciro Alegría','country' => 'PE','private' => false],
            ///desde aca privadas
            ['name' => 'Pontificia Universidad Católica del Perú','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana Cayetano Heredia','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica de Santa María','country' => 'PE','private' => true],
            ['name' => 'Universidad del Pacífico','country' => 'PE','private' => true],
            ['name' => 'Universidad de Lima','country' => 'PE','private' => true],
            ['name' => 'Universidad de San Martín de Porres','country' => 'PE','private' => true],
            ['name' => 'Universidad Femenina del Sagrado Corazón','country' => 'PE','private' => true],
            ['name' => 'Universidad Inca Garcilaso de la Vega','country' => 'PE','private' => true],
            ['name' => 'Universidad de Piura','country' => 'PE','private' => true],
            ['name' => 'Universidad Ricardo Palma','country' => 'PE','private' => true],
            ['name' => 'Universidad Andina Néstor Cáceres Velásquez','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana Los Andes','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana Unión','country' => 'PE','private' => true],
            ['name' => 'Universidad Andina del Cusco','country' => 'PE','private' => true],
            ['name' => 'Universidad Tecnológica de los Andes','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada de Tacna','country' => 'PE','private' => true],
            ['name' => 'Universidad Particular de Chiclayo','country' => 'PE','private' => true],
            ['name' => 'Universidad San Pedro (*1)','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Antenor Orrego','country' => 'PE','private' => true],
            ['name' => 'Universidad de Huánuco','country' => 'PE','private' => true],
            ['name' => 'Universidad José Carlos Mariátegui (*2)','country' => 'PE','private' => true],
            ['name' => 'Universidad Marcelino Champagnat','country' => 'PE','private' => true],
            ['name' => 'Universidad Científica del Perú (*3)','country' => 'PE','private' => true],
            ['name' => 'Universidad César Vallejo S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica Los Ángeles de Chimbote (*4)','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana de Ciencias Aplicadas S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada del Norte S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad San Ignacio de Loyola S.A.','country' => 'PE','private' => true],
            ['name' => 'Universidad Alas Peruanas','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Norbert Wiener','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica San Pablo','country' => 'PE','private' => true],
            ['name' => 'Grupo Educativo Universidad Privada de Ica S.A.C. (*5 *13)','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada San Juan Bautista S.A.C. (*6)','country' => 'PE','private' => true],
            ['name' => 'Universidad Tecnológica del Perú','country' => 'PE','private' => true],
            ['name' => 'Universidad Continental S.A.C. (*7)','country' => 'PE','private' => true],
            ['name' => 'Universidad Científica del Sur S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica Santo Toribio de Mogrovejo','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Antonio Guillermo Urrelo','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica Sedes Sapientiae','country' => 'PE','private' => true],
            ['name' => 'Universidad Señor de Sipán','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica de Trujillo Benedicto XVI (*8','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana de las Américas','country' => 'PE','private' => true],
            ['name' => 'Universidad ESAN','country' => 'PE','private' => true],
            ['name' => 'Universidad Antonio Ruiz de Montoya','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana de Ciencias e Informática','country' => 'PE','private' => true],
            ['name' => 'Universidad para el Desarrollo Andino','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Telesup','country' => 'PE','private' => true],
            ['name' => 'Universidad Sergio Bernales S.A.','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada de Pucallpa S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Autónoma de Ica S.A.C. (*9)','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada de Trujillo','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada San Carlos','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana Simón Bolivar','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana de Integración Global S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana del Oriente S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Autónoma del Perú','country' => 'PE','private' => true],
            ['name' => 'Universidad de Ciencias y Humanidades','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Juan Mejía Baca','country' => 'PE','private' => true],
            ['name' => 'Universidad Jaime Bausate y Meza','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana del Centro','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Arzobispo Loayza S.A.C','country' => 'PE','private' => true],
            ['name' => 'Universidad Le Cordon Bleu S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada de Huancayo Franklin Roosevelt','country' => 'PE','private' => true],
            ['name' => 'Universidad de Lambayeque S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad de Ciencias y Artes de América Latina S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana de Arte Orval S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada de la Selva Peruana (*10)','country' => 'PE','private' => true],
            ['name' => 'Universidad Ciencias de la Salud','country' => 'PE','private' => true],
            ['name' => 'Universidad de Ayacucho Federico Froebel','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana de Investigación y Negocios S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Peruana Austral del Cusco','country' => 'PE','private' => true],
            ['name' => 'Universidad Autónoma San Francisco','country' => 'PE','private' => true],
            ['name' => 'Universidad San Andrés','country' => 'PE','private' => true],
            ['name' => 'Universidad Interamericana para el Desarrollo','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Juan Pablo II','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Leonardo Da Vinci S.A.C. (*11)','country' => 'PE','private' => true],
            ['name' => 'Universidad de Ingeniería y Tecnología','country' => 'PE','private' => true],
            ['name' => 'Universidad La Salle','country' => 'PE','private' => true],
            ['name' => 'Universidad Latinoamericana CIMA','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Autónoma del Sur','country' => 'PE','private' => true],
            ['name' => 'Universidad María Auxiliadora','country' => 'PE','private' => true],
            ['name' => 'Universidad Politécnica Amazónica S.A.C.','country' => 'PE','private' => true],
            ['name' => 'Universidad Santo Domingo de Guzmán','country' => 'PE','private' => true],
            ['name' => 'Universidad Marítima del Perú','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Líder Peruana','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada Peruano Alemana S.AC.','country' => 'PE','private' => true],
            ['name' => 'Universidad Global del Cusco','country' => 'PE','private' => true],
            ['name' => 'Universidad Santo Tomás de Aquino de Ciencia e Integración','country' => 'PE','private' => true],
            ['name' => 'Universidad Privada SISE','country' => 'PE','private' => true],
            ['name' => 'Universidad Seminario Evangélico de Lima (*12)','country' => 'PE','private' => true],
            ['name' => 'Universidad Seminario Bíblico Andino (*12)','country' => 'PE','private' => true],
            ['name' => 'Universidad Católica San José','country' => 'PE','private' => true]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
}
