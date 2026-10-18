<?php

namespace App\Models\Muk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collateral extends Model
{
    use HasFactory;

    protected $connection = 'muk';
    protected $table = 'limac_collaterals';
    protected $guarded = ['id'];

    // Relasi ke tabel limac (karena foreign key-nya adalah limac_id)
    public function limac()
    {
        return $this->belongsTo(\App\Models\Muk\Limac::class, 'limac_id');
    }
}