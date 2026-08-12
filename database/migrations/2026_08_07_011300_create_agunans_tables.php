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
        // Tabel Umum Agunan (Menyimpan data dasar dan relasi)
        Schema::create('agunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained(); // Relasi ke tabel debiturs
            $table->string('jenis_agunan'); // tanah_sawah, kendaraan, dll
            $table->timestamps();
        });

        // Tabel Detail Tanah
        Schema::create('agunan_tanah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agunan_id')->constrained('agunans')->onDelete('cascade');
            $table->tinyInteger('urutan'); // Menandakan 1, 2, atau 3
    
    // Kolom data jaminan (tanpa angka di belakang)
            $table->string('kepemilikan', 500);
            $table->string('alamat', 500);
            $table->string('share_location', 300)->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('denah', 300)->nullable();
            $table->unsignedBigInteger('harga_tanah')->nullable();
            $table->unsignedBigInteger('harga_bangunan')->nullable();
            $table->text('info_harga1')->nullable();
            $table->text('info_harga2')->nullable();
            $table->text('info_harga3')->nullable();
            $table->string('jaminan_lain', 50)->nullable();
            
            $table->timestamps();
        });

        // Tabel Detail Kendaraan
        Schema::create('agunan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agunan_id')->constrained('agunans');
            $table->text('spesifikasi');
            $table->string('status_kepemilikan');
            $table->decimal('harga_taksasi', 15, 2);
            $table->string('harga_taksasi_sumber_lain');
            $table->timestamps();
        });

        // Tabel Detail Simpanan
        Schema::create('agunan_simpanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agunan_id')->constrained('agunans');
            $table->string('jenis_simpanan');
            $table->decimal('nilai_simpanan', 15, 2);
            $table->timestamps();
        });

        // Tabel Detail Logam
        Schema::create('agunan_logam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agunan_id')->constrained('agunans');
            $table->string('jenis_logam');
            $table->decimal('berat', 15, 2);
            $table->string('harga_beli_tahun_perolehan');
            $table->decimal('harga_saatini', 15, 2);
            $table->timestamps();
        });

        // Tabel Detail Yang Lain
        Schema::create('yang_lain', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agunan_id')->constrained('agunans');
            $table->string('jaminan_lainnya_jikaada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yang_lain');
        Schema::dropIfExists('agunan_logam');
        Schema::dropIfExists('agunan_simpanan');
        Schema::dropIfExists('agunan_kendaraan');
        Schema::dropIfExists('agunan_tanah');
        Schema::dropIfExists('agunans');
    }
};
