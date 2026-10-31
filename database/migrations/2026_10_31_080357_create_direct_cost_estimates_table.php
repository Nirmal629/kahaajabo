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
        Schema::create('direct_cost_estimates', function (Blueprint $table) {
            $table->id();
            $table->integer('area_managerId');
            $table->string('pickup_location');
            $table->string('pickup_latitude')->nullable();
            $table->string('pickup_longitude')->nullable();
            $table->string('dropoff_location');
            $table->string('dropoff_latitude')->nullable();
            $table->string('dropoff_longitude')->nullable();
            $table->decimal('estimated_distance', 10, 2)->nullable();
            $table->string('vehicle_category')->nullable();
            $table->decimal('total_estimated_fare', 10, 2)->default(0);
            $table->enum('status', ['pending', 'Approved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_cost_estimates');
    }
};
