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
            $table->string('first_name')->nullable()->after('name');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('last_name')->nullable()->after('middle_name');
            $table->bigInteger('phone_number')->nullable()->unique()->after('email');
            $table->bigInteger('secondary_mobile')->nullable()->unique()->after('phone_number');
            $table->text('address')->nullable()->after('password');
            $table->date('registration_date')->nullable()->after('address');
            $table->boolean('status')->nullable()->default(true)->after('registration_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['phone_number']);
            $table->dropUnique(['secondary_mobile']);

            $table->dropColumn([
                'first_name',
                'middle_name',
                'last_name',
                'phone_number',
                'secondary_mobile',
                'address',
                'registration_date',
                'status',
            ]);
        });
    }
};
