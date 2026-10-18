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
        Schema::create('limac_collaterals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('limac_id')->constrained('limac')->onDelete('cascade');
            
            $table->integer('urutan')->default(1);
            $table->string('no_shm');
            $table->string('luas');
            $table->string('pemilik');
            $table->text('letak_shm');
            $table->string('ringkasan_penilaian_jaminan', 300)->nullable();
            $table->string('tanggal')->nullable(); 
            $table->text('info_harga_tanah1')->nullable(); 
            $table->text('info_harga_tanah2')->nullable(); 
            $table->text('info_harga_tanah3')->nullable();
            $table->text('batas_objek_jaminan')->nullable();
            $table->text('catatan_khusus')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limac_collaterals');
    }
};