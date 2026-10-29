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
        if (!Schema::hasTable('education_materials')) {
            Schema::create('education_materials', function (Blueprint $table) {
                $table->id();
                $table->string('category')->unique(); // 'organik', 'plastik', 'kertas', 'logam_kaca'
                $table->string('title');
                $table->string('color_badge');
                $table->string('icon')->default('sparkles');
                $table->text('summary');
                $table->text('sorting_guide');
                $table->text('recycling_impact');
                $table->text('eco_theology_quote');
                $table->string('eco_theology_ref');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_materials');
    }
};
