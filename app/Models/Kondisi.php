<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;

    protected $table = 'kondisi';

    protected $fillable = [
        'debitur_id',
        'berkas_take_over',
    ];

    // Otomatis ubah format JSON dari database menjadi array PHP dan sebaliknya
    protected $casts = [
        'berkas_take_over' => 'array',
    ];

    // Relasi ke model Debitur
    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}