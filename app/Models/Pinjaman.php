<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';

    protected $fillable = [
        'debitur_id',
        'urutan',
        'nama_ljk',
        'plafon',
        'outstanding',
        'kolekbilitas',
        'angsuran',
        'jkw',
        'keterangan',
        'apakah_ada_pinjaman_dibank_lain',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}