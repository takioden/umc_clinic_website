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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal');
            $table->enum('poli', ['umum', 'gigi'])->default('umum');
            $table->enum('status', ['menunggu', 'sedang ditangani', 'selesai'])->default('menunggu');
            $table->foreignId('pasien_id')->nullable()->constrained('pasiens')->onDelete('set null');
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
