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
        Schema::create('dataslik', function (Blueprint $table) {
        $table->id();
        $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
        $table->enum('apakah_debitur_memiliki_pinjaman', ['YA', 'TIDAK ADA']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataslik');
    }
};
