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
        Schema::create('vehicle_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_type_id')
                ->constrained('vehicle_types')
                ->cascadeOnDelete();

            $table->string('vehicle_name');
            $table->string('vehicle_image')->nullable();
            $table->decimal('price_per_km', 10, 2);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_rates');
    }
};
