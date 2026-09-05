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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number', 15)->unique()->nullable();

            $table->bigInteger('country_id');
            $table->bigInteger('state_id');
            $table->bigInteger('district_id');
            $table->bigInteger('city_id');
            $table->bigInteger('area_id');
            $table->bigInteger('area_manager_id');

            $table->text('complete_address')->nullable();

            // Identity
            $table->string('aadhar_card_number', 12)->nullable();
            $table->text('aadhar_card_file')->nullable();
            $table->string('pan_card_number', 10)->nullable();
            $table->text('pan_card_file')->nullable();

            $table->string('bank_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->text('bank_passBook_file')->nullable();

            // Driving License
            $table->string('driving_license')->nullable();
            $table->date('license_start_date')->nullable();
            $table->date('license_end_date')->nullable();
            $table->text('driving_license_file')->nullable();

            // Employment
            $table->date('register_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
