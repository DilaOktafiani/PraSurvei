<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debitur extends Model
{
    use HasFactory;

    // Izinkan semua kolom ini diisi sekaligus
    protected $fillable = [
        'no_register',
        'nama',
        'usia',
        'usaha',
        'lama_usaha',
        'alamat_ktp',
        'alamat_domisili',
        'nama_pasangan',
        'usia_pasangan',
        'plafon',
        'plafon_terbilang',
        'tujuan_penggunaan',
        'jangka_waktu',
        'estimasi_kewajiban',
        'tipe_fasilitas',
    ];

    // Otomatis mengubah array fasilitas menjadi JSON saat disimpan ke database
    protected $casts = [
        'tipe_fasilitas' => 'array',
    ];
}