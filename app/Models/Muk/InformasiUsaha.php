<?php

namespace App\Models\Muk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiUsaha extends Model
{
    use HasFactory;

    protected $connection = 'muk';

    protected $table = 'informasi_usaha';
    
    protected $guarded = ['id'];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }
}