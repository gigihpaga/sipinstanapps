<?php

namespace Database\Seeders;

use App\Models\PangkatGolongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PangkatGolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PangkatGolongan::create(['nama' => 'II/c PENGATUR',]);
        PangkatGolongan::create(['nama' => 'II/d PENGATUR TINGKAT 1',]);
        PangkatGolongan::create(['nama' => 'III/a PENATA MUDA',]);
        PangkatGolongan::create(['nama' => 'III/b PENATA MUDA TINGKAT 1',]);
        PangkatGolongan::create(['nama' => 'III/c PENATA',]);
        PangkatGolongan::create(['nama' => 'III/d PENATA TINGKAT 1',]);
        PangkatGolongan::create(['nama' => 'IV/a PEMBINA',]);
        PangkatGolongan::create(['nama' => 'IV/b PEMBINA TINGKAT 1',]);
        PangkatGolongan::create(['nama' => 'IV/c PEMBINA UTAMA MUDA',]);
    }
}
