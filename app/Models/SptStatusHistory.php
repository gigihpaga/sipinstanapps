<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SptStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'spt_status_history';
    protected $guarded = ['id'];
}
