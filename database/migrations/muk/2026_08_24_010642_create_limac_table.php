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

            $table->foreignId('debitur_id')
                  ->constrained('debiturs')
                  ->onDelete('cascade');

            // 1. CAPITAL
            $table->text('capital');

           // 2. COLLATERAL
            $table->string('no_shm');
            $table->string('luas');
            $table->string('pemilik');
            $table->text('letak_shm');
            $table->string('ringkasan_penilaian_jaminan', 300)->nullable();
            $table->string('tanggal')->nullable(); 
            $table->text('info_harga_tanah1'); 
            $table->text('info_harga_tanah2')->nullable(); 
            $table->text('info_harga_tanah3')->nullable();
            $table->text('batas_objek_jaminan');
            $table->text('catatan_khusus');

            // 3. CONDITION
            $table->text('condition');

            // 4. CAPACITY
            $table->string('capacity', 300)->nullable();
            $table->text('keluarga');
            $table->text('anak');
            $table->text('pendidikan');

            // 5. CHARACTER
            $table->text('internal');
            $table->text('eksternal');

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