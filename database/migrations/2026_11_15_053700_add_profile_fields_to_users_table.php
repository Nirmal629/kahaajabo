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
      
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable();

            $table->string('skill_level')->nullable();
            $table->string('currency')->nullable();
            $table->string('timezone')->nullable();

            $table->enum('email_notification', ['yes', 'no'])->nullable();
            $table->enum('call_text_chat_consent', ['yes', 'no'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'dob',
                'skill_level',
                'currency',
                'timezone',
                'email_notification',
                'call_text_chat_consent',
            ]);
        });
    }
};
