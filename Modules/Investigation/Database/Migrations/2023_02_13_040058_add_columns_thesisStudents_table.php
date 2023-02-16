<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsThesisStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inve_thesis_students', function (Blueprint $table) {
            $table->decimal('top_margin')->nullable();
            $table->decimal('bottom_margin')->nullable();
            $table->decimal('left_margin')->nullable();
            $table->decimal('right_margin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inve_thesis_students', function (Blueprint $table) {
            $table->dropColumn('bottom_margin');
            $table->dropColumn('top_margin');
            $table->dropColumn('left_margin');
            $table->dropColumn('right_margin');
        });
    }
}
