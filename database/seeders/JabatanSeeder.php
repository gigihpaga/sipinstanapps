<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Jabatan::create(['nama' => 'ANALIS KEBIJAKAN AHLI MUDA',]);
        Jabatan::create(['nama' => 'ANALIS RENCANA PROGRAM DAN KEGIATAN',]);
        Jabatan::create(['nama' => 'AUDITOR AHLI MUDA',]);
        Jabatan::create(['nama' => 'AUDITOR AHLI PERTAMA',]);
        Jabatan::create(['nama' => 'INSPEKTUR INSPEKTORAT',]);
        Jabatan::create(['nama' => 'INSPEKTUR PEMBANTU INSPEKTUR PEMBANTU WILAYAH I',]);
        Jabatan::create(['nama' => 'INSPEKTUR PEMBANTU INSPEKTUR PEMBANTU WILAYAH II',]);
        Jabatan::create(['nama' => 'INSPEKTUR PEMBANTU INSPEKTUR PEMBANTU WILAYAH III',]);
        Jabatan::create(['nama' => 'INSPEKTUR PEMBANTU INSPEKTUR PEMBANTU WILAYAH IV',]);
        Jabatan::create(['nama' => 'JF PENGAWAS PENYELENGGARAAN URUSAN PEMERINTAHAN DAERAH (PPUPD) AHLI PERTAMA',]);
        Jabatan::create(['nama' => 'KEPALA SUB BAGIAN ADMINISTRASI UMUM DAN KEUANGAN ',]);
        Jabatan::create(['nama' => 'PENGADMINISTRASI KEUANGAN',]);
        Jabatan::create(['nama' => 'PENGADMINISTRASI UMUM',]);
        Jabatan::create(['nama' => 'PENGAWAS PENYELENGGARAAN URUSAN PEMERINTAHAN DI DAERAH AHLI MADYA',]);
        Jabatan::create(['nama' => 'PENGAWAS PENYELENGGARAAN URUSAN PEMERINTAHAN DI DAERAH AHLI MUDA',]);
        Jabatan::create(['nama' => 'PENGAWAS PENYELENGGARAAN URUSAN PEMERINTAHAN DI DAERAH AHLI PERTAMA',]);
        Jabatan::create(['nama' => 'PENGELOLA EVALUASI TINDAK LANJUT LAPORAN HASIL PEMERIKSAAN',]);
        Jabatan::create(['nama' => 'PENYUSUN PROGRAM ANGGARAN DAN PELAPORAN',]);
        Jabatan::create(['nama' => 'PENYUSUN RENCANA TINDAK LANJUT DAN HASIL PENGAWASAN',]);
        Jabatan::create(['nama' => 'PERENCANA AHLI MUDA',]);
        Jabatan::create(['nama' => 'SEKRETARIS SEKRETARIAT',]);
    }
}
