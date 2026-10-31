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
        Schema::create('request_call_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('mobile_number')->nullable()->default(12);
            $table->bigInteger('secondaryMobile_number')->nullable()->default(12);
            $table->text('home_address')->nullable();
            $table->text('office_address')->nullable();
            $table->text('message')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_call_enquiries');
    }
};
