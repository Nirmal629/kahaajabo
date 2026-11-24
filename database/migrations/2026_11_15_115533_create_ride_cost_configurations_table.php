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
        Schema::create('ride_cost_configurations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_managerId');

            $table->unsignedBigInteger('vehicle_type_id');

            $table->decimal('gas_cost', 10, 2)->default(0);

            $table->enum('vehicle_input', [
                'Petrol',
                'Diesel',
                'CNG',
                'EV'
            ]);

            $table->decimal('per_km_cost', 10, 2)->default(0);
            $table->decimal('car_maintenance', 10, 2)->default(0);
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->decimal('driver_cost', 10, 2)->default(0);
            $table->enum('status', ['pending', 'Approved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_cost_configurations');
    }
};
