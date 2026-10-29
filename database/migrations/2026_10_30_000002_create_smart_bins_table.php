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
        if (!Schema::hasTable('smart_bins')) {
            Schema::create('smart_bins', function (Blueprint $table) {
                $table->id();
                $table->string('station_code')->unique(); // e.g. 'STATION-01'
                $table->string('name');
                $table->string('location_name');
                $table->decimal('latitude', 10, 7);
                $table->decimal('longitude', 10, 7);
                $table->enum('status', ['active', 'maintenance', 'full'])->default('active');
                $table->integer('capacity_organic')->default(0);
                $table->integer('capacity_plastic')->default(0);
                $table->integer('capacity_paper')->default(0);
                $table->integer('capacity_metal')->default(0);
                $table->boolean('is_online')->default(true);
                $table->timestamp('last_ping_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_bins');
    }
};
