<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSlik extends Model
{
    use HasFactory;

    protected $table = 'dataslik';

    protected $fillable = [
        'debitur_id',
        'apakah_debitur_memiliki_pinjaman',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}

