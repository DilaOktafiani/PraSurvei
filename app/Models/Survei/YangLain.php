<?php

namespace App\Models\Survei;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YangLain extends Model
{
    use HasFactory;
    protected $connection = 'survei';

    protected $table = 'yang_lain';
    protected $guarded = ['id'];

    public function agunan()
    {
        return $this->belongsTo(Agunan::class, 'agunan_id');
    }
}