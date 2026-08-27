<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    use HasFactory;

    protected $table = 'capital';

    protected $fillable = [
        'debitur_id',
        'aset1',
        'aset2',
        'aset3',
        'aset4',
        'aset5',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }
}