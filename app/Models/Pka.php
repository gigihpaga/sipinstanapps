<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pka extends Model
{
    use HasFactory;

    protected $table = 'pka';
    protected $guarded = ['id'];

    // join ke table spt
    public function spt()
    {
        return $this->hasOne(Spt::class);
    }
}
