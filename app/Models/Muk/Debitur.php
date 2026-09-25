<?php

namespace App\Models\Muk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debitur extends Model
{
    use HasFactory;

    protected $connection = 'muk';

    protected $table = 'debiturs';
    
    protected $fillable = [
        'no_register',
        'nama',
        'tempat_tanggal_lahir',
        'nama_ibu_kandung',
        'nama_istri_penjamin',
        'alamat_ktp',
        'alamat_domisili',
        'no_hp',
        'pekerjaan',
        'bidang_usaha',
        'alamat_usaha',
        'kontak',
        'idi_di_bank_lain',
        'keterangan',
    ];

    protected $casts = [
        // 'tipe_fasilitas' => 'array', // Aktifkan jika kolom ini ada di database
    ];

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