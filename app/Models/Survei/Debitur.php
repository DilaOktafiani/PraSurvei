<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debitur extends Model
{
    use HasFactory;
    protected $connection = 'survei';

    protected $table = 'debiturs';
    
    protected $fillable = [
        'no_register',
        'nama',
        'temuan_ca',
        'plafon',
        'tujuan_penggunaan',
        'jangka_waktu',
        'estimasi_kewajiban',
        'tipe_fasilitas',
    ];

    protected $casts = [
        'tipe_fasilitas' => 'array',
    ];

    public function agunans()
    {
        return $this->hasMany(Agunan::class, 'debitur_id', 'id');
    }
    
    public function agunan_kendaraan()
    {
        return $this->hasManyThrough(AgunanKendaraan::class, Agunan::class, 'debitur_id', 'agunan_id', 'id', 'id');
    }

    public function agunan_logam()
    {
        return $this->hasManyThrough(AgunanLogam::class, Agunan::class, 'debitur_id', 'agunan_id', 'id', 'id');
    }

    public function agunan_simpanan()
    {
        return $this->hasManyThrough(AgunanSimpanan::class, Agunan::class, 'debitur_id', 'agunan_id', 'id', 'id');
    }

    public function agunan_tanah()
    {
        return $this->hasManyThrough(AgunanTanah::class, Agunan::class, 'debitur_id', 'agunan_id', 'id', 'id');
    }

    public function yang_lain()
    {
        return $this->hasManyThrough(YangLain::class, Agunan::class, 'debitur_id', 'agunan_id', 'id', 'id');
    }

    public function analisis_jaminan()
    {
        return $this->hasOne(AnalisisJaminan::class, 'debitur_id', 'id');
    }

    public function badanusaha()
    {
        return $this->hasOne(BadanUsaha::class, 'debitur_id', 'id');
    }

    public function berkas_lengkap()
    {
        return $this->hasOne(BerkasLengkap::class, 'debitur_id', 'id');
    }

    public function capacity()
    {
        return $this->hasOne(Capacity::class, 'debitur_id', 'id');
    }

    public function capital()
    {
        return $this->hasOne(Capital::class, 'debitur_id', 'id');
    }

    public function dataslik()
    {
        return $this->hasOne(DataSlik::class, 'debitur_id', 'id');
    }

    public function data_tambahan()
    {
        return $this->hasOne(DataTambahan::class, 'debitur_id', 'id');
    }

    public function kondisi()
    {
        return $this->hasOne(Kondisi::class, 'debitur_id', 'id');
    }

    public function mutasi_rekening()
    {
        return $this->hasOne(MutasiRekening::class, 'debitur_id', 'id');
    }

    public function mutasi_rekening1()
    {
        return $this->hasMany(MutasiRekening1::class, 'debitur_id', 'id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'debitur_id', 'id');
    }

    public function swot()
    {
        return $this->hasOne(Swot::class, 'debitur_id', 'id');
    }

    public function takeover()
    {
        return $this->hasOne(TakeOver::class, 'debitur_id', 'id');
    }
}