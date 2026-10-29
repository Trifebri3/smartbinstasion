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
        if (!Schema::hasTable('waste_deposits')) {
            Schema::create('waste_deposits', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('station_code')->default('STATION-01');
                $table->string('category'); // 'organik', 'plastik', 'kertas', 'logam_kaca'
                $table->string('category_label');
                $table->float('confidence')->default(0.0);
                $table->integer('points_earned')->default(0);
                $table->string('target_bin')->default('BIN 1');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_deposits');
    }
};
