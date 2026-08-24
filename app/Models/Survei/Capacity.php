<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    use HasFactory;

    // Menggunakan koneksi 'survei' sesuai contoh Anda
    protected $connection = 'survei';

    protected $table = 'capacity';
    
    protected $guarded = ['id'];

    // Cast kolom kelengkapan_berkas agar otomatis menjadi array saat diambil dari database
    protected $casts = [
        'kelengkapan_berkas' => 'array',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }
}