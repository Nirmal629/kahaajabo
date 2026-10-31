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
        Schema::create('vehicle_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicle_details')->onDelete('cascade');
            $table->string('registration_certificate')->nullable();
            $table->string('insurance_policy_file')->nullable();
            $table->string('insurance_policy_number')->nullable();
            $table->date('insurance_policy_startDate')->nullable();
            $table->date('insurance_policy_endDate')->nullable();
            $table->string('fitness_certificate_file')->nullable();
            $table->string('fitness_certificate_number')->nullable();
            $table->date('fitness_certificate_startDate')->nullable();
            $table->date('fitness_certificate_endDate')->nullable();
            $table->string('allIndia_tourist_permit_file')->nullable();
            $table->string('allIndia_tourist_permit_number')->nullable();
            $table->date('allIndia_tourist_permit_startDate')->nullable();
            $table->date('allIndia_tourist_permit_endDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_documents');
    }
};
