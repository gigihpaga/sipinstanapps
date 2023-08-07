<?php

namespace Database\Seeders;

use App\Models\Spt;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Spt::create([
            'pka_id' => 2,
            'pemohon_spt' => 2, //user_id
            'sifat_tugas' => fake()->randomElement(['PKPT', 'Non-PKPT']),
            'status_buat' => '1', // selesai
            'nomor_pengajuan' => 'PENG/DEV/' . Carbon::now('asia/jakarta')->format('m-s') . '/' . Str::random(5),
            'lama_penugasan' => fake()->randomDigitNot(0),
            'tanggal_mulai' => fake()->dateTimeBetween($startDate = '-100 days',  'now', 'Asia/Jakarta'),
            'tanggal_selesai' => Carbon::now()->addDay(8),
            'keperluan_tugas' => fake()->sentence(20, true),
            'keterangan_tugas' => fake()->sentence(5, true),
            'note' => fake()->sentence(3, true),
            'created_by' => 2, //user_id
            'updated_by' => '',
        ]);
        Spt::create([
            'pka_id' => 3,
            'pemohon_spt' => 3, //user_id
            'sifat_tugas' => fake()->randomElement(['PKPT', 'Non-PKPT']),
            'status_buat' => '1', // selesai
            'nomor_pengajuan' => 'PENG/DEV/' . Carbon::now('asia/jakarta')->format('m-s') . '/' . Str::random(5),
            'lama_penugasan' => fake()->randomDigitNot(0),
            'tanggal_mulai' => fake()->dateTimeBetween($startDate = '-100 days',  'now', 'Asia/Jakarta'),
            'tanggal_selesai' => Carbon::now()->addDay(8),
            'keperluan_tugas' => fake()->sentence(20, true),
            'keterangan_tugas' => fake()->sentence(5, true),
            'note' => fake()->sentence(3, true),
            'created_by' => 3, //user_id
            'updated_by' => '',
        ]);
        Spt::create([
            'pka_id' => 1,
            'pemohon_spt' => 1, //user_id
            'sifat_tugas' => fake()->randomElement(['PKPT', 'Non-PKPT']),
            'status_buat' => '0', // draft
            'nomor_pengajuan' => 'PENG/DEV/' . Carbon::now('asia/jakarta')->format('m-s') . '/' . Str::random(5),
            'lama_penugasan' => fake()->randomDigitNot(0),
            'tanggal_mulai' => fake()->dateTimeBetween($startDate = '-100 days',  'now', 'Asia/Jakarta'),
            'tanggal_selesai' => Carbon::now()->addDay(8),
            'keperluan_tugas' => fake()->sentence(20, true),
            'keterangan_tugas' => fake()->sentence(5, true),
            'note' => fake()->sentence(3, true),
            'created_by' => 1, //user_id
            'updated_by' => '',
        ]);
    }
}
