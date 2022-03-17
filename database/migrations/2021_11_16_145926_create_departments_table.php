<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        DB::table('departments')->insert([
            ['id' => '01', 'description' => 'AMAZONAS','country_id'],
            ['id' => '02', 'description' => 'ÁNCASH','country_id'],
            ['id' => '03', 'description' => 'APURIMAC','country_id'],
            ['id' => '04', 'description' => 'AREQUIPA','country_id'],
            ['id' => '05', 'description' => 'AYACUCHO','country_id'],
            ['id' => '06', 'description' => 'CAJAMARCA','country_id'],
            ['id' => '07', 'description' => 'CALLAO','country_id'],
            ['id' => '08', 'description' => 'CUSCO','country_id'],
            ['id' => '09', 'description' => 'HUANCAVELICA','country_id'],
            ['id' => '10', 'description' => 'HUÁNUCO','country_id'],
            ['id' => '11', 'description' => 'ICA','country_id'],
            ['id' => '12', 'description' => 'JUNÍN','country_id'],
            ['id' => '13', 'description' => 'LA LIBERTAD','country_id'],
            ['id' => '14', 'description' => 'LAMBAYEQUE','country_id'],
            ['id' => '15', 'description' => 'LIMA','country_id'],
            ['id' => '16', 'description' => 'LORETO','country_id'],
            ['id' => '17', 'description' => 'MADRE DE DIOS','country_id'],
            ['id' => '18', 'description' => 'MOQUEGUA','country_id'],
            ['id' => '19', 'description' => 'PASCO','country_id'],
            ['id' => '20', 'description' => 'PIURA','country_id'],
            ['id' => '21', 'description' => 'PUNO','country_id'],
            ['id' => '22', 'description' => 'SAN MARTIN','country_id'],
            ['id' => '23', 'description' => 'TACNA','country_id'],
            ['id' => '24', 'description' => 'TUMBES','country_id'],
            ['id' => '25', 'description' => 'UCAYALI','country_id'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
