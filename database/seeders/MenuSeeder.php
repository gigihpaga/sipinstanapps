<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Menu::create([
            'sort' => 1,
            'display_name' => 'Konfigurasi',
            'type' => 'main_menu',
            'parrent_menu_id' => null,
            'url' => 'konfigurasi',
            'icon' => 'ti-settings',
        ]);
        Menu::create([
            'sort' => 2,
            'display_name' => 'Roles',
            'type' => 'sub_menu',
            'parrent_menu_id' => 1,
            'url' => 'konfigurasi/roles',
            'icon' => '',
        ]);
        Menu::create([
            'sort' => 3,
            'display_name' => 'Permissions',
            'type' => 'sub_menu',
            'parrent_menu_id' => 1,
            'url' => 'konfigurasi/permissions',
            'icon' => '',
        ]);
    }
}
