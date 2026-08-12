<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgunanKendaraan extends Model
{
    use HasFactory;

    protected $table = 'agunan_kendaraan';
    protected $guarded = ['id'];

    public function agunan()
    {
        return $this->belongsTo(Agunan::class, 'agunan_id');
    }
}