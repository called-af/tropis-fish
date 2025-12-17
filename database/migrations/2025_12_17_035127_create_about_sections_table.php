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
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description_1');
            $table->text('description_2')->nullable();
            $table->string('image_path');
            $table->string('feature_1_title')->nullable();
            $table->string('feature_1_description')->nullable();
            $table->string('feature_1_icon')->default('check-circle');
            $table->string('feature_2_title')->nullable();
            $table->string('feature_2_description')->nullable();
            $table->string('feature_2_icon')->default('currency-dollar');
            $table->string('feature_3_title')->nullable();
            $table->string('feature_3_description')->nullable();
            $table->string('feature_3_icon')->default('truck');
            $table->string('feature_4_title')->nullable();
            $table->string('feature_4_description')->nullable();
            $table->string('feature_4_icon')->default('heart');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
