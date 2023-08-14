<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DasarTugas extends Model
{
    use HasFactory;

    protected $table = 'dasar_tugas';
    protected $guarded = ['id'];

    public function spt()
    {
        return $this->belongsTo(Spt::class);
    }
}
