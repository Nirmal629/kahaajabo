<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('area_managers', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->change();
            $table->unsignedBigInteger('state_id')->change();
            $table->unsignedBigInteger('district_id')->change();
            $table->unsignedBigInteger('city_id')->change();
            $table->unsignedBigInteger('area_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('area_managers', function (Blueprint $table) {
            $table->bigInteger('country_id')->change();
            $table->bigInteger('state_id')->change();
            $table->bigInteger('district_id')->change();
            $table->bigInteger('city_id')->change();
            $table->bigInteger('area_id')->change();
        });
    }
};
