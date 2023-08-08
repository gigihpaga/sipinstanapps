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
        Menu::create([
            'sort' => 4,
            'display_name' => 'Dokumen',
            'type' => 'main_menu',
            'parrent_menu_id' => null,
            'url' => 'dokumen',
            'icon' => 'ti-files',
        ]);
        Menu::create([
            'sort' => 5,
            'display_name' => 'PKA dan SPT',
            'type' => 'sub_menu',
            'parrent_menu_id' => 4,
            'url' => 'dokumen/pkaspt',
            'icon' => '',
        ]);
        Menu::create([
            'sort' => 6,
            'display_name' => 'Master',
            'type' => 'main_menu',
            'parrent_menu_id' => null,
            'url' => 'master',
            'icon' => ' ti-folder',
        ]);
        Menu::create([
            'sort' => 7,
            'display_name' => 'Jabatan',
            'type' => 'sub_menu',
            'parrent_menu_id' => 6,
            'url' => 'master/jabatan',
            'icon' => '',
        ]);
        Menu::create([
            'sort' => 8,
            'display_name' => 'Pangkat Golongan',
            'type' => 'sub_menu',
            'parrent_menu_id' => 6,
            'url' => 'master/pangkat_golongan',
            'icon' => '',
        ]);
        Menu::create([
            'sort' => 9,
            'display_name' => 'Kelas Perjadin',
            'type' => 'sub_menu',
            'parrent_menu_id' => 6,
            'url' => 'master/kelas_perjadin',
            'icon' => '',
        ]);
        Menu::create([
            'sort' => 10,
            'display_name' => 'Pegawai',
            'type' => 'sub_menu',
            'parrent_menu_id' => 6,
            'url' => 'master/pegawai',
            'icon' => '',
        ]);
    }
}
