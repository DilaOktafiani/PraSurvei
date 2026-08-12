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
        Schema::create('infousaha', function (Blueprint $table) {
        $table->id();
        $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
        $table->decimal('omset_usaha', 15, 2);
        $table->decimal('biaya_operasional', 15, 2);
        $table->decimal('penghasilan_tambahan', 15, 2);
        $table->decimal('pengeluaran_rumah_tangga', 15, 2);
        $table->decimal('angsuran_bank_lain', 15, 2);
        $table->decimal('angsuran_bpr', 15, 2);
        $table->text('deskripsi_usaha');
        $table->json('kelengkapan_berkas')->nullable(); // Menggunakan tipe data JSON untuk checkbox array
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infousaha');
    }
};
