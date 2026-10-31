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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->after('password');
            $table->unsignedBigInteger('state_id')->nullable()->after('country_id');
            $table->unsignedBigInteger('district_id')->nullable()->after('state_id');
            $table->unsignedBigInteger('city_id')->nullable()->after('district_id');
            $table->unsignedBigInteger('area_id')->nullable()->after('city_id');
            $table->boolean('profile_completed')->default(false)->after('area_id');
        });

        Schema::table('external_users', function (Blueprint $table) {
            $table->boolean('profile_completed')->default(false)->after('area_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'country_id',
                'state_id',
                'district_id',
                'city_id',
                'area_id',
                'profile_completed',
            ]);
        });

        Schema::table('external_users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_completed',
            ]);
        });
    }
};
