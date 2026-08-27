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

    protected $casts = [
        'berkas_take_over' => 'array',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}