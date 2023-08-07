<?php

namespace Database\Seeders;

use App\Models\DasarTugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DasarTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DasarTugas::create([
            'spt_id' => 1,
            'dasar_tugas' => fake()->sentence(15, true),
            'created_by' => 2, //user_id
        ]);
        DasarTugas::create([
            'spt_id' => 1,
            'dasar_tugas' => fake()->sentence(5, true),
            'created_by' => 2, //user_id
        ]);
        DasarTugas::create([
            'spt_id' => 1,
            'dasar_tugas' => fake()->sentence(10, true),
            'created_by' => 2, //user_id
        ]);
        DasarTugas::create([
            'spt_id' => 2,
            'dasar_tugas' => fake()->sentence(20, true),
            'created_by' => 3, //user_id
        ]);
        DasarTugas::create([
            'spt_id' => 2,
            'dasar_tugas' => fake()->sentence(3, true),
            'created_by' => 3, //user_id
        ]);
    }
}
