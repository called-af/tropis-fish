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
        Schema::create('company_sections', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['about', 'farm', 'quality'])->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('main_description_1');
            $table->text('main_description_2')->nullable();
            $table->string('main_title_1')->nullable();
            $table->string('main_title_2')->nullable();
            $table->json('images')->nullable();
            $table->json('content_blocks')->nullable();
            $table->json('process_steps')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_sections');
    }
};
