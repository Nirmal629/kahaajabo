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
        Schema::create('home_all_sections', function (Blueprint $table) {
            $table->id();
            $table->text('sectionSecond_title');
            $table->text('sectionSection_description')->nullable();
            $table->text('third_section_title')->nullable();
            $table->text('fourth_section_heading')->nullable();
            $table->text('fourth_section_title_1')->nullable();
            $table->text('fourth_section_description_1')->nullable();
            $table->string('fourth_section_image_1')->nullable();
            $table->text('fourth_section_title_2')->nullable();
            $table->text('fourth_section_description_2')->nullable();
            $table->string('fourth_section_image_2')->nullable();
            $table->text('fourth_section_title_3')->nullable();
            $table->text('fourth_section_description_3')->nullable();
            $table->string('fourth_section_image_3')->nullable();
            $table->text('fourth_section_title_4')->nullable();
            $table->text('fourth_section_description_4')->nullable();
            $table->string('fourth_section_image_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_all_sections');
    }
};
