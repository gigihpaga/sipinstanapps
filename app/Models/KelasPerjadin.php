<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPerjadin extends Model
{
    use HasFactory;


    protected $table = 'kelas_perjadin';
    protected $guarded = ['id'];
}
