<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // call seeder
        $this->call([
            BagianSeeder::class,
            UserRolePermisionSeeder::class,
            MenuSeeder::class,
            JabatanSeeder::class,
            PangkatGolonganSeeder::class,
            KelasPerjadinSeeder::class,
            PegawaiSeeder::class,
            PkaSeeder::class,
            SptSeeder::class,
            AnggotaSeeder::class,
            DasarTugasSeeder::class,
            SptStatusHistorySeeder::class,
        ]);
    }
}
