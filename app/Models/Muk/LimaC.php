<?php

namespace App\Models\Muk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimaC extends Model
{
    use HasFactory;

    protected $connection = 'muk';
    protected $table = 'limac';
    protected $guarded = ['id'];

    public function debitur()
    {
        return $this->belongsTo(\App\Models\Debitur::class, 'debitur_id');
    }

    // Relasi untuk 1 Collateral Utama (jika hanya butuh 1)
    public function collateral()
    {
        return $this->hasOne(\App\Models\Muk\Collateral::class, 'limac_id');
    }

    // --- TAMBAHKAN INI AGAR BISA MENGAMBIL BANYAK/TAMBAHAN COLLATERAL ---
    public function collaterals()
    {
        return $this->hasMany(\App\Models\Muk\Collateral::class, 'limac_id');
    }
}