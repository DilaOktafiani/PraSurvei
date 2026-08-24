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
        Schema::create('capacity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade'); 
            $table->text('deskripsi_usaha');
            $table->text('informasi_penghasilan_utama');
            $table->text('informasi_penghasilan_pendukung')->nullable();
            $table->decimal('pengeluaran_rumah_tangga', 15, 2);
            $table->decimal('angsuran_bank_lain', 15, 2);
            $table->decimal('angsuran_bpr', 15, 2);
            $table->text('analisis_kapasitas');
            $table->string('mutasi_rekening')->nullable();
            $table->json('kelengkapan_berkas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacity');
    }
};