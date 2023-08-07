<?php

namespace Database\Seeders;

use App\Models\Pka;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Pka::create(
            [
                'pka_no' => 'PKA/DEV/' . Carbon::now('Asia/Jakarta')->format('m-s') . '/' . Str::random(5),
                'nama_opd' => fake()->company(),
                'alamat' => fake()->address(),
                'sasaran' => fake()->sentence(20, true),
                'tanggal_mulai' => Carbon::now()->subDays(10),
                'tanggal_selesai' => Carbon::now()->subDays(3),
                'created_by' => 1, // user_id
                'updated_by' => fake()->randomDigitNot(0),
                'nama_file_pdf' => 'PKA/DEV' . Carbon::now('Asia/Jakarta')->format('m-s') . '/' . Str::random(5) . '.pdf',
            ],
        );
        Pka::create(
            [
                'pka_no' => 'PKA/DEV/' . Carbon::now('Asia/Jakarta')->format('m-s') . '/' . Str::random(5),
                'nama_opd' => fake()->company(),
                'alamat' => fake()->streetAddress(),
                'sasaran' => fake()->sentence(20, true),
                'tanggal_mulai' => Carbon::now()->subDays(8),
                'tanggal_selesai' => Carbon::now()->subDays(2),
                'created_by' => 2, // user_id
                'updated_by' => fake()->randomDigitNot(0),
                'nama_file_pdf' => 'PKA/DEV' . Carbon::now('Asia/Jakarta')->format('m-s') . '/' . Str::random(5) . '.pdf',
            ],
        );
        Pka::create(
            [
                'pka_no' => 'PKA/DEV/' . Carbon::now('Asia/Jakarta')->format('m-s') . '/' . Str::random(5),
                'nama_opd' => fake()->company(),
                'alamat' => fake()->streetAddress(),
                'sasaran' => fake()->sentence(20, true),
                'tanggal_mulai' => Carbon::now()->subDays(9),
                'tanggal_selesai' => Carbon::now()->subDays(0),
                'created_by' => 3, // user_id
                'updated_by' => fake()->randomDigitNot(0),
                'nama_file_pdf' => 'PKA/DEV' . Carbon::now('Asia/Jakarta')->format('m-s') . '/' . Str::random(5) . '.pdf',
            ],
        );
    }
}
