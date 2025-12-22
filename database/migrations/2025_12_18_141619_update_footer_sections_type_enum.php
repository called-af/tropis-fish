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
        if (Schema::hasTable('footer_sections') && config('database.default') !== 'sqlite') {
            Schema::table('footer_sections', function (Blueprint $table) {
                \DB::statement("ALTER TABLE footer_sections MODIFY COLUMN type ENUM('company', 'menu', 'information', 'social')");
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('footer_sections') && config('database.default') !== 'sqlite') {
            Schema::table('footer_sections', function (Blueprint $table) {
                \DB::statement("ALTER TABLE footer_sections MODIFY COLUMN type ENUM('menu', 'information', 'social')");
            });
        }
    }
};
