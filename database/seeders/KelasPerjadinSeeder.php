<?php

namespace Database\Seeders;

use App\Models\KelasPerjadin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasPerjadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KelasPerjadin::create(['kategori' => 'A']);
        KelasPerjadin::create(['kategori' => 'B']);
        KelasPerjadin::create(['kategori' => 'C']);
    }
}
