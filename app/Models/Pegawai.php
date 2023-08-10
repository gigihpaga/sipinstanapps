<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = ['id'];

    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
    }

    public function pangkatGolongan()
    {
        return $this->hasOne(PangkatGolongan::class, 'id', 'pangkat_golongan_id');
    }

    public function kelasPerjadin()
    {
        return $this->hasOne(KelasPerjadin::class, 'id', 'kelas_perjadin_id');
    }
}
