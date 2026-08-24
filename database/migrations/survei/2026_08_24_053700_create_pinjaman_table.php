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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->integer('urutan')->default(1); // Menyimpan indeks data pinjaman ke-n
            $table->string('nama_ljk');
            $table->decimal('plafond', 15, 2);
            $table->decimal('outstanding', 15, 2);
            $table->string('kolekbilitas');
            $table->decimal('angsuran', 15, 2);
            $table->string('keterangan');
            $table->string('jkw')->nullable();
            $table->string('jalan');
            $table->string('bunga')->nullable();
            $table->enum('apakah_ada_pinjaman_lain', ['YA', 'TIDAK ADA'])->nullable();
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
        Schema::dropIfExists('pinjaman');
    }
};