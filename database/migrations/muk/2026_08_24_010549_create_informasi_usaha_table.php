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
        Schema::create('informasi_usaha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade'); 
            $table->text('gambaran_pekerjaan_debitur1');
            $table->string('perhitungan_omset_usaha1', 300)->nullable();
            $table->text('gambaran_pekerjaan_debitur2');
            $table->string('perhitungan_omset_usaha2', 300)->nullable();
            $table->text('gambaran_pekerjaan_debitur3');
            $table->string('perhitungan_omset_usaha3', 300)->nullable();
            $table->text('usaha_pendukung1');
            $table->string('perhitungan_omset_pendukung1', 300)->nullable();
            $table->text('usaha_pendukung2');
            $table->string('perhitungan_omset_pendukung2', 300)->nullable();
            $table->text('usaha_pendukung3');
            $table->string('perhitungan_omset_pendukung3', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_usaha');
    }
};