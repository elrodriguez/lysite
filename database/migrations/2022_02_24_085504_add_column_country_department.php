<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCountryDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->string('country_id',2)->nullable();
            $table->foreign('country_id','departments_country_id_fk')->references('id')->on('countries');
        });

        DB::table('departments')->insert([
            ['id' => '01', 'description' => 'AMAZONAS','country_id' => 'PE'],
            ['id' => '02', 'description' => 'ÁNCASH','country_id' => 'PE'],
            ['id' => '03', 'description' => 'APURIMAC','country_id' => 'PE'],
            ['id' => '04', 'description' => 'AREQUIPA','country_id' => 'PE'],
            ['id' => '05', 'description' => 'AYACUCHO','country_id' => 'PE'],
            ['id' => '06', 'description' => 'CAJAMARCA','country_id' => 'PE'],
            ['id' => '07', 'description' => 'CALLAO','country_id' => 'PE'],
            ['id' => '08', 'description' => 'CUSCO','country_id' => 'PE'],
            ['id' => '09', 'description' => 'HUANCAVELICA','country_id' => 'PE'],
            ['id' => '10', 'description' => 'HUÁNUCO','country_id' => 'PE'],
            ['id' => '11', 'description' => 'ICA','country_id' => 'PE'],
            ['id' => '12', 'description' => 'JUNÍN','country_id' => 'PE'],
            ['id' => '13', 'description' => 'LA LIBERTAD','country_id' => 'PE'],
            ['id' => '14', 'description' => 'LAMBAYEQUE','country_id' => 'PE'],
            ['id' => '15', 'description' => 'LIMA','country_id' => 'PE'],
            ['id' => '16', 'description' => 'LORETO','country_id' => 'PE'],
            ['id' => '17', 'description' => 'MADRE DE DIOS','country_id' => 'PE'],
            ['id' => '18', 'description' => 'MOQUEGUA','country_id' => 'PE'],
            ['id' => '19', 'description' => 'PASCO','country_id' => 'PE'],
            ['id' => '20', 'description' => 'PIURA','country_id' => 'PE'],
            ['id' => '21', 'description' => 'PUNO','country_id' => 'PE'],
            ['id' => '22', 'description' => 'SAN MARTIN','country_id' => 'PE'],
            ['id' => '23', 'description' => 'TACNA','country_id' => 'PE'],
            ['id' => '24', 'description' => 'TUMBES','country_id' => 'PE'],
            ['id' => '25', 'description' => 'UCAYALI','country_id' => 'PE'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('departments_country_id_fk');
            $table->dropColumn('country_id');
        });
    }
}
