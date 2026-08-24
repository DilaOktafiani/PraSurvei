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
        Schema::create('berkas_lengkap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->text('analisis_kelengkapan_berkas');
            $table->enum('apakah_badan_usaha', ['YA', 'TIDAK']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_lengkap');
    }
};