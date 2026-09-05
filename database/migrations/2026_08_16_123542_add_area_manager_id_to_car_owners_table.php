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
        Schema::table('car_owners', function (Blueprint $table) {
            $table->unsignedBigInteger('area_manager_id')->change();

            $table->foreign('area_manager_id')
                ->references('id')
                ->on('area_managers')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_owners', function (Blueprint $table) {
            $table->dropForeign(['area_manager_id']);
            $table->bigInteger('area_manager_id')->change();
        });
    }
};
