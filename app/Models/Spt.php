<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    use HasFactory;

    protected $table = 'spt';
    protected $guarded = ['id'];

    // join ke pka
    public function pka()
    {
        return $this->hasOne(Pka::class, 'id', 'pka_id');
    }

    // join ke table user
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'pemohon_spt');
    }

    // join ke table spt_status_history
    public function statusHistorys()
    {
        return $this->hasMany(SptStatusHistory::class);
    }

    // join ke table spt_status_history, dan ambil id terbesar (paling akhir)
    public function lastStatusHistory()
    {
        // ambil id terbesar dari status history
        return $this->hasOne(SptStatusHistory::class)->latestOfMany();
    }
}
