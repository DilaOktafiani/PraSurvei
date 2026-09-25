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
        Schema::create('limac', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->text('capital');
            $table->text('collateral');
            $table->string('ringkasan_penilaian_jaminan', 300)->nullable();
            $table->text('tanggal');
            $table->text('info_harga_tanah1');
            $table->text('info_harga_tanah2');
            $table->text('info_harga_tanah3');
            $table->text('batas_objek_jaminan');
            $table->text('catatan_khusus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limac');
    }
};