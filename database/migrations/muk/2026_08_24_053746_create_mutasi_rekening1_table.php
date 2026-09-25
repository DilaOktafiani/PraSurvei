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
        Schema::create('mutasi_rekening1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->integer('urutan')->default(1); // Menyimpan indeks mutasi rekening ke-n
            $table->string('nama_bank');
            $table->string('bulan');
            $table->decimal('debet', 15, 2);
            $table->decimal('kredit', 15, 2);
            $table->string('saldo');
            $table->enum('apakah_masih_ada_mutasi_tabungan', ['YA', 'TIDAK ADA'])->nullable();
            $table->timestamps();

            // Memastikan kombinasi debitur dan urutan unik
            $table->unique(['debitur_id', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_rekening1');
    }
};