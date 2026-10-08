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


    public function denah()
    {
        return $this->hasOne(Denah::class, 'debitur_id', 'id');
    }

    public function deviasi()
    {
        return $this->hasOne(Deviasi::class, 'debitur_id', 'id');
    }

    public function informasi_usaha()
    {
        return $this->hasMany(InformasiUsaha::class, 'debitur_id', 'id');
    }

    public function jaminan()
    {
        return $this->hasOne(Jaminan::class, 'debitur_id', 'id');
    }

    public function kesimpulan()
    {
        return $this->hasOne(Kesimpulan::class, 'debitur_id', 'id');
    }

    public function limac()
    {
        return $this->hasOne(LimaC::class, 'debitur_id', 'id');
    }

    public function pengajuan_plafon_kredit()
    {
        return $this->hasOne(PlafonKredit::class, 'debitur_id', 'id');
    }

    public function referensi_ca()
    {
        return $this->hasOne(ReferensiCA::class, 'debitur_id', 'id');
    }

    public function rumah()
    {
        return $this->hasOne(Rumah::class, 'debitur_id', 'id');
    }

    public function spesifikasi()
    {
        return $this->hasOne(Spesifikasi::class, 'debitur_id', 'id');
    }

    public function usaha()
    {
        return $this->hasMany(Usaha::class, 'debitur_id', 'id');
    }

}