<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUsaha extends Model
{
    use HasFactory;

    protected $table = 'infousaha';

    protected $fillable = [
        'debitur_id',
        'omset_usaha',
        'biaya_operasional',
        'penghasilan_tambahan',
        'pengeluaran_rumah_tangga',
        'angsuran_bank_lain',
        'angsuran_bpr',
        'deskripsi_usaha',
        'kelengkapan_berkas',
    ];

    // Otomatis mengubah tipe data JSON di database menjadi array PHP
    protected $casts = [
        'kelengkapan_berkas' => 'array',
    ];
}