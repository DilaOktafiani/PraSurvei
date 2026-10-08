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
            $table->integer('urutan')->default(1);
            $table->text('gambaran_pekerjaan_debitur');
            $table->string('perhitungan_omset_usaha', 300)->nullable();
            $table->text('usaha_pendukung')->nullable();
            $table->string('perhitungan_omset_pendukung', 300)->nullable();
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