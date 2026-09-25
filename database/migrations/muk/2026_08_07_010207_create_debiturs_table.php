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
            $table->string('tempat_tanggal_lahir');
            $table->string('nama_ibu_kandung');
            $table->string('nama_istri_penjamin');
            $table->text('alamat_ktp');
            $table->text('alamat_domisili');
            $table->string('no_hp');
            $table->string('pekerjaan');
            $table->string('bidang_usaha');
            $table->text('alamat_usaha');
            $table->string('kontak');
            $table->string('idi_di_bank_lain', 300)->nullable();
            $table->text('keterangan');
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
