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
        Schema::create('spesifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->text('sertifikat')->nullable();
            $table->text('nomor_nib')->nullable();
            $table->text('luas_tanah')->nullable(); 
            $table->text('luas_bangunan')->nullable();
            $table->text('lebar_depan')->nullable();
            $table->text('pbg')->nullable();
            $table->text('orientasi')->nullable(); 
            $table->text('kamar_tidur')->nullable();
            $table->text('ruang_keluarga')->nullable();
            $table->text('ruang_tamu')->nullable();
            $table->text('kamar_pembantu')->nullable(); 
            $table->text('gudang')->nullable();
            $table->text('garasi')->nullable();
            $table->text('kamar_mandi')->nullable();
            $table->text('ruang_makan')->nullable();
            $table->text('dapur')->nullable(); 
            $table->text('pekarangan')->nullable();
            $table->text('carport')->nullable();
            $table->text('ruangan_lain')->nullable();
            $table->text('fasilitas_lain')->nullable();
            $table->text('kondisi_bangunan')->nullable(); 
            $table->text('kondisi_lantai')->nullable();
            $table->text('kondisi_plafon')->nullable();
            $table->text('bahan_atap')->nullable();
            $table->text('struktur_atap')->nullable(); 
            $table->text('listrik')->nullable();
            $table->text('air')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesifikasi');
    }
};