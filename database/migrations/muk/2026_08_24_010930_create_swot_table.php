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
        Schema::create('swot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->text('kekuatan');
            $table->text('kelemahan');
            $table->text('peluang');
            $table->text('ancaman');
            $table->text('kesimpulan');
            $table->enum('rekomendasi', ['Disetujui', 'Disetujui dengan syarat', 'Ditolak']);
            $table->text('syarat_catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swot');
    }
};