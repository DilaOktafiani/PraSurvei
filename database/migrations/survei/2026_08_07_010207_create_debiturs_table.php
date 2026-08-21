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
        Schema::create('debiturs', function (Blueprint $table) {
            $table->id();
            $table->string('no_register');
            $table->string('nama');
            $table->string('temuan_ca');
            $table->decimal('plafon', 15, 2);
            $table->text('tujuan_penggunaan');
            $table->string('jangka_waktu');
            $table->decimal('estimasi_kewajiban', 15, 2);
            $table->json('tipe_fasilitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debiturs');
    }
};
