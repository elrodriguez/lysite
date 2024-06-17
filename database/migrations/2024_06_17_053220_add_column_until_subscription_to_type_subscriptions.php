<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_subscriptions', function (Blueprint $table) {
            $table->date('until_subscription')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_subscriptions', function (Blueprint $table) {
            $table->dropColumn('until_subscription');
            // Agrega más instrucciones dropColumn si es necesario
        });
    }
};
