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
            $table->string('usia');
            $table->string('usaha');
            $table->string('lama_usaha');
            $table->text('alamat_ktp');
            $table->text('alamat_domisili');
            $table->string('nama_pasangan'); // Menghapus ->nullable() karena wajib diisi
            $table->string('usia_pasangan'); // Menghapus ->nullable() karena wajib diisi
            $table->decimal('plafon', 15, 2);
            $table->string('plafon_terbilang');
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
