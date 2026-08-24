<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTambahan extends Model
{
    use HasFactory;

    protected $connection = 'survei';
    protected $table = 'data_tambahan';
    protected $guarded = ['id'];

    public function debitur()
    {
        return $this->belongsTo(\App\Models\Debitur::class, 'debitur_id');
    }
}