<?php

namespace App\Models\Muk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlafonKredit extends Model
{
    use HasFactory;
    protected $connection = 'muk';

    protected $table = 'pengajuan_plafon_kredit';

    protected $fillable = [
        'debitur_id',
        'pengajuan_plafon_kredit',
        'tujuan_penggunaan',
    ];

    // Relasi ke model Debitur
    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }
}