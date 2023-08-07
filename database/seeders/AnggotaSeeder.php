<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        function defaultValue()
        {
            $defaultData = [
                'pegawai_id' => fake()->numberBetween(1, 48),
                'lama_tugas' => fake()->numberBetween(1, 31),
            ];
            return $defaultData;
        };

        // spt 1
        Anggota::create(array_merge(
            ['spt_id' => 1, 'jabatan_penugasan' => 1,], // penanggungjawab
            defaultValue(),
        ));
        Anggota::create(array_merge(
            ['spt_id' => 1, 'jabatan_penugasan' => 2,], // pengawas
            defaultValue(),
        ));
        Anggota::create(array_merge(
            ['spt_id' => 1, 'jabatan_penugasan' => 3,], // ketua
            defaultValue(),
        ));
        // loop anggota dengan jabatan
        for ($idx = 0; $idx <= 7; $idx++) {
            Anggota::create(array_merge(
                ['spt_id' => 1, 'jabatan_penugasan' => 4,], //anggota
                defaultValue(),
            ));
        }

        // spt 2
        Anggota::create(array_merge(
            ['spt_id' => 2, 'jabatan_penugasan' => 1,], // penanggungjawab
            defaultValue(),
        ));
        Anggota::create(array_merge(
            ['spt_id' => 2, 'jabatan_penugasan' => 2,], // pengawas
            defaultValue(),
        ));
        Anggota::create(array_merge(
            ['spt_id' => 2, 'jabatan_penugasan' => 3,], // ketua
            defaultValue(),
        ));
        // loop anggota dengan jabatan
        for ($idx = 0; $idx <= 5; $idx++) {
            Anggota::create(array_merge(
                ['spt_id' => 2, 'jabatan_penugasan' => 4,], //anggota
                defaultValue(),
            ));
        }
    }
}
