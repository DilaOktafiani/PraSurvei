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
        'apakah_badan_usaha',
    ];

    protected $casts = [
        'ktp' => 'array',
        'slik' => 'array',
        'kk' => 'array',
        'surat_nikah' => 'array',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}