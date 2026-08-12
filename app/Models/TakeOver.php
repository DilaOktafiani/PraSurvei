<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeOver extends Model
{
    use HasFactory;

    protected $table = 'takeover';

    protected $fillable = [
        'debitur_id',
        'apakah_kredit_take_over',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class);
    }
}

