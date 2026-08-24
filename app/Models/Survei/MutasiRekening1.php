<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiRekening1 extends Model
{
    use HasFactory;

    protected $connection = 'survei';
    protected $table = 'mutasi_rekening1';
    protected $guarded = ['id'];

    public function debitur()
    {
        return $this->belongsTo(\App\Models\Debitur::class, 'debitur_id');
    }
}