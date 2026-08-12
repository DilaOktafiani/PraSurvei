<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadanUsaha extends Model
{
    use HasFactory;

    protected $table = 'badanusaha';

    protected $fillable = [
        'debitur_id',
        'berkas_badan_usaha',
    ];

    // Otomatis ubah format JSON dari database menjadi array PHP dan sebaliknya
    protected $casts = [
        'berkas_badan_usaha' => 'array',
    ];

    // Relasi ke model Debitur
    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}