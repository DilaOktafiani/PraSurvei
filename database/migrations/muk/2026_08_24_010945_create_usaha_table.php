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
        Schema::create('usaha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            $table->integer('urutan')->default(1);
            $table->text('nama_usaha');  
            $table->string('google_maps', 300)->nullable();
            $table->string('share_location', 300)->nullable();
            $table->string('kode_qr', 300)->nullable();
            $table->longText('foto_usaha', 300)->nullable();
            $table->enum('apakah_ada_usaha_lain', ['YA', 'TIDAK ADA']);
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
        Schema::dropIfExists('usaha');
    }
};