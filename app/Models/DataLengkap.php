<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLengkap extends Model
{
    use HasFactory;

    protected $table = 'datalengkap';

    protected $fillable = [
        'debitur_id',
        'ktp',
        'slik',
        'kk',
        'surat_nikah',
    ];

    // Otomatis ubah format JSON dari database menjadi array PHP dan sebaliknya
    protected $casts = [
        'ktp' => 'array',
        'slik' => 'array',
        'kk' => 'array',
        'surat_nikah' => 'array',
    ];

    // Relasi ke model Debitur
    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}