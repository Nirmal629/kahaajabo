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
        Schema::table('vehicle_details', function (Blueprint $table) {
            $table->string('vehicle_owner_type')->nullable()->after('registration_number');
            $table->bigInteger('vehicle_owner_id')->nullable()->after('vehicle_owner_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_details', function (Blueprint $table) {
            $table->dropColumn('vehicle_owner_type');
            $table->dropColumn('vehicle_owner_id');
        });
    }
};
