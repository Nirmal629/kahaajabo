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
        Schema::table('external_users', function (Blueprint $table) {
            $table->string('otp')->after('user_type')->nullable();
            $table->timestamp('otp_expires_at')->after('otp')->nullable();
            $table->unsignedTinyInteger('otp_attempts')->after('otp_expires_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('external_users', function (Blueprint $table) {
            $table->dropColumn('otp');
            $table->dropColumn('otp_expires_at');
            $table->dropColumn('otp_attempts');
        });
    }
};
