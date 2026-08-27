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

    protected $casts = [
        'berkas_badan_usaha' => 'array',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}