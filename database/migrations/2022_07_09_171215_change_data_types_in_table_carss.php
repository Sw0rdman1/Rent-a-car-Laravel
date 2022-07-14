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
        Schema::table('cars', function (Blueprint $table) {
            $table->integer('cubic_capacity')->change();
            $table->integer('horse_powers')->change();
            $table->integer('year_of_production')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('cubic_capacity')->change();
            $table->string('horse_powers')->change();
            $table->string('year_of_production')->change();
        });
    }
};
