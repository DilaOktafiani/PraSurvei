<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    use HasFactory;

    protected $connection = 'survei';

    protected $table = 'capacity';
    
    protected $guarded = ['id'];

    protected $casts = [
        'kelengkapan_berkas' => 'array',
    ];

    public function debitur()
    {
        return $this->belongsTo(Debitur::class, 'debitur_id');
    }
}