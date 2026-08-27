<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agunan extends Model
{
    use HasFactory;

    protected $table = 'agunans';
    protected $guarded = ['id'];

    // Relasi ke Debitur 
    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }

    // Relasi ke Tanah
    public function tanah()
    {
        return $this->hasOne(AgunanTanah::class, 'agunan_id');
    }

    // Relasi ke Kendaraan
    public function kendaraan()
    {
        return $this->hasOne(AgunanKendaraan::class, 'agunan_id');
    }

    // Relasi ke Simpanan
    public function simpanan()
    {
        return $this->hasOne(AgunanSimpanan::class, 'agunan_id');
    }

    // Relasi ke Logam Mulia
    public function logam()
    {
        return $this->hasOne(AgunanLogam::class, 'agunan_id');
    }

    // Relasi ke Yang Lain
    public function yangLain()
    {
        return $this->hasOne(YangLain::class, 'agunan_id');
    }
}