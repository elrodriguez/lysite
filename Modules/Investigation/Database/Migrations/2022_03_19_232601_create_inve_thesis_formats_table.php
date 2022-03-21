<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInveThesisFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inve_thesis_formats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('type_thesis')->comment('experimental, descriptiva, meta-descriptiva, metodologica, teorica, etc');
            $table->string('normative_thesis')->comment('APA, Vancouver u otros');
            $table->unsignedBigInteger('school_id');
            $table->timestamps();
            $table->foreign('school_id')->references('id')->on('universities_schools');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inve_thesis_formats');
    }
}
