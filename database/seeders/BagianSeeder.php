<?php

namespace Database\Seeders;

use App\Models\Bagian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bagian::create([
            'nama' => 'IRBAN 1',
        ]);
        Bagian::create([
            'nama' => 'IRBAN 2',
        ]);
    }
}
