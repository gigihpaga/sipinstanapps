<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    use HasFactory;

    protected $table = 'spt';
    protected $guarded = ['id'];

    // scope
    public function scopeFilter($query, array $filters)
    {
        // [a.1] with isset  and ternary operator
        // if (isset($filters['f_pemohon_spt']) ? isset($filters['f_pemohon_spt']) : false) {
        //     return $query->where('pemohon_spt', '=', $filters);
        // }

        // [a.2] with when() method and Null coalescing operator
        $query->when($filters['f_pemohon_spt'] ?? false, function ($query, $f_pemohon_spt) {
            return $query->where('pemohon_spt', '=', $f_pemohon_spt);
            // menambah where
            // ->orWhere();
        });

        $query->when($filters['f_sifat_tugas'] ?? false, function ($query, $f_sifat_tugas) {
            return $query->where('sifat_tugas', '=', $f_sifat_tugas);
        });

        // [b.1]. methode 1 tanpa arrow function, harus menggunakan keyword use agar function ke_2 biasa mengakses parameter pada function ke_1
        // $query->when($filters['f_last_status_history'] ?? false, function ($query, $f_sifat_tugas) {
        //     // chaining filter with join table
        //     return $query->whereHas('lastStatusHistory',  function ($query) use ($f_sifat_tugas) {
        //         $query->where('status', '=', $f_sifat_tugas);
        //     });
        // });

        // [b.2]. methode 2 menggunakan arrow function
        $query->when($filters['f_last_status_history'] ?? false, function ($query, $f_sifat_tugas) {
            // chaining filter with join table
            return $query->whereHas('lastStatusHistory',  fn ($query) =>  $query->where('status', '=', $f_sifat_tugas));
        });
    }

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

    public function dasarTugas()
    {
        return $this->hasMany(DasarTugas::class);
    }
}
