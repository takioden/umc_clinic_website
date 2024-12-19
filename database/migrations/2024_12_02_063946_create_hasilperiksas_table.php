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
        Schema::create('hasilperiksas', function (Blueprint $table) {
            $table->id();
            $table->text('kondisi');
            $table->text('resep_obat');
            $table->text('catatan');
            $table->foreignId('reservasi_id')->constrained('reservasis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasilperiksas');
    }
};
