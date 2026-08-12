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
            $table->integer('urutan')->default(1); // 1 sampai 20
            $table->string('nama_ljk');
            $table->decimal('plafon', 15, 2);
            $table->decimal('outstanding', 15, 2);
            $table->string('kolekbilitas');
            $table->decimal('angsuran', 15, 2);
            $table->string('jkw')->nullable();
            $table->string('keterangan');
            $table->enum('apakah_ada_pinjaman_dibank_lain', ['YA', 'TIDAK ADA']);
            $table->timestamps();
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
            
