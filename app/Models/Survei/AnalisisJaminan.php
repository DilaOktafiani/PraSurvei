<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisJaminan extends Model
{
    use HasFactory;
    protected $connection = 'survei';

    protected $table = 'analisis_jaminan';

    protected $fillable = [
        'debitur_id',
        'analisis_jaminan',
    ];

    // Relasi ke model Debitur
    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }
}