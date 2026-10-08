<?php

namespace App\Models\Muk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesifikasi extends Model
{
    use HasFactory;

    protected $connection = 'muk';
    protected $table = 'spesifikasi';
    protected $guarded = ['id'];

    public function debitur()
    {
        return $this->belongsTo(\App\Models\Debitur::class, 'debitur_id');
    }
}