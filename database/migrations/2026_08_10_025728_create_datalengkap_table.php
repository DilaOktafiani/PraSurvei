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
        Schema::create('datalengkap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->json('ktp')->nullable();
            $table->json('slik')->nullable();
            $table->json('kk')->nullable();
            $table->json('surat_nikah')->nullable();
            $table->enum('apakah_badan_usaha', ['YA', 'TIDAK'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datalengkap');
    }
};
