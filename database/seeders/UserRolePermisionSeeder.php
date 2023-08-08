<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $default_value = [
            'email_verified_at' => now(),
            'password' => bcrypt('admin'), // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            // insert data ke table user
            $paga = User::create(array_merge( // 1
                [
                    'name' => 'Paga Admin',
                    'username' => 'paga',
                    'bagian_id' => 1,
                    'email' => 'useradmin@mail.com',
                ],
                $default_value
            ));
            $ido = User::create(array_merge( // 2
                [
                    'name' => 'Ido Manager',
                    'username' => 'ido',
                    'bagian_id' => 1,
                    'email' => 'usermanager@mail.com',
                ],
                $default_value
            ));
            $dani = User::create(array_merge( // 3
                [
                    'name' => 'Dani Spv',
                    'username' => 'dani',
                    'bagian_id' => 1,
                    'email' => 'userspv@mail.com',
                ],
                $default_value
            ));
            $tika = User::create(array_merge( // 4
                [
                    'name' => 'Tika Staff',
                    'username' => 'tika',
                    'bagian_id' => 1,
                    'email' => 'userstaff@mail.com',
                ],
                $default_value
            ));
            $dian = User::create(array_merge( // 5
                [
                    'name' => 'Dian Admin',
                    'username' => 'dian',
                    'bagian_id' => 1,
                    'email' => 'dianadmin@mail.com',
                ],
                $default_value
            ));

            // insert data ke table roles
            $role_admin = Role::create(['name' => 'admin']); // 1
            $role_manager = Role::create(['name' => 'manager']); // 2
            $role_spv = Role::create(['name' => 'spv']); // 3
            $role_staff = Role::create(['name' => 'staff']); // 4

            // insert data ke table permissions
            $permision = Permission::create(['name' => 'read_konfigurasi']); // 1
            $permision = Permission::create(['name' => 'read_konfigurasi/roles']); // 2
            $permision = Permission::create(['name' => 'create_konfigurasi/roles']); // 3
            $permision = Permission::create(['name' => 'update_konfigurasi/roles']); // 4
            $permision = Permission::create(['name' => 'delete_konfigurasi/roles']); // 5
            Permission::create(['name' => 'read_konfigurasi/permissions']); // 6
            Permission::create(['name' => 'create_konfigurasi/permissions']); // 7
            Permission::create(['name' => 'update_konfigurasi/permissions']); // 8
            Permission::create(['name' => 'delete_konfigurasi/permissions']); // 9

            Permission::create(['name' => 'read_dokumen']); //
            Permission::create(['name' => 'read_dokumen/pkaspt']); //
            Permission::create(['name' => 'create_dokumen/pkaspt']); //
            Permission::create(['name' => 'update_dokumen/pkaspt']); //
            Permission::create(['name' => 'delete_dokumen/pkaspt']); //

            // main menu : master
            Permission::create(['name' => 'read_master']); //

            // jabatan
            Permission::create(['name' => 'read_master/jabatan']); //
            Permission::create(['name' => 'create_master/jabatan']); //
            Permission::create(['name' => 'update_master/jabatan']); //
            Permission::create(['name' => 'delete_master/jabatan']); //

            // pangkat golongan
            Permission::create(['name' => 'read_master/pangkat_golongan']); //
            Permission::create(['name' => 'create_master/pangkat_golongan']); //
            Permission::create(['name' => 'update_master/pangkat_golongan']); //
            Permission::create(['name' => 'delete_master/pangkat_golongan']); //

            // kelas perjadin
            Permission::create(['name' => 'read_master/kelas_perjadin']); //
            Permission::create(['name' => 'create_master/kelas_perjadin']); //
            Permission::create(['name' => 'update_master/kelas_perjadin']); //
            Permission::create(['name' => 'delete_master/kelas_perjadin']); //

            // pegawai
            Permission::create(['name' => 'read_master/pegawai']); //
            Permission::create(['name' => 'create_master/pegawai']); //
            Permission::create(['name' => 'update_master/pegawai']); //
            Permission::create(['name' => 'delete_master/pegawai']); //


            /**
             * memasangkan role admin ke permision,
             * data ini akan masuk table role_has_permissions
             * jika permision yang di pasangkan tidak ada di table permision, migration akan gagal. tidak ada pesan error, tatapi data seeder tidak masuk ke database
             */
            $role_admin->givePermissionTo(['read_konfigurasi', 'read_konfigurasi/roles', 'read_konfigurasi/permissions']); // 1 (4,2,6)
            // $role_admin->givePermissionTo(['update_konfigurasi/roles', 'read_konfigurasi/roles', 'read_konfigurasi/users']); // 1 (4,2,6)
            $role_admin->givePermissionTo('create_konfigurasi/roles');
            $role_admin->givePermissionTo('update_konfigurasi/roles');
            $role_admin->givePermissionTo('delete_konfigurasi/roles');


            // master submenu
            $role_admin->givePermissionTo('read_master');

            // jabatan
            $role_admin->givePermissionTo('read_master/jabatan');
            $role_admin->givePermissionTo('create_master/jabatan');
            $role_admin->givePermissionTo('update_master/jabatan');
            $role_admin->givePermissionTo('delete_master/jabatan');

            // pangkat golongan
            $role_admin->givePermissionTo('read_master/pangkat_golongan');
            $role_admin->givePermissionTo('create_master/pangkat_golongan');
            $role_admin->givePermissionTo('update_master/pangkat_golongan');
            $role_admin->givePermissionTo('delete_master/pangkat_golongan');

            // kelas perjadian
            $role_admin->givePermissionTo('read_master/kelas_perjadin');
            $role_admin->givePermissionTo('create_master/kelas_perjadin');
            $role_admin->givePermissionTo('update_master/kelas_perjadin');
            $role_admin->givePermissionTo('delete_master/kelas_perjadin');

            // pegawai
            $role_admin->givePermissionTo('read_master/pegawai');
            $role_admin->givePermissionTo('create_master/pegawai');
            $role_admin->givePermissionTo('update_master/pegawai');
            $role_admin->givePermissionTo('delete_master/pegawai');

            // pka spt
            $role_admin->givePermissionTo([
                'read_dokumen',
                'read_dokumen/pkaspt',
                'create_dokumen/pkaspt',
                'update_dokumen/pkaspt',
                'delete_dokumen/pkaspt',
            ]);

            /**
             * memasangkan data user dengan data permision menggunakan relasi spatie
             * di insert ke table model_has_roles
             * SELECT u.id AS user_id , u.name, u.email , mhr.*, r.* FROM users u
             * JOIN model_has_roles mhr ON u.id = mhr.model_id
             * JOIN roles r ON mhr.role_id = r.id
             * ORDER BY u.id asc
             *
             */
            $paga->assignRole('admin');
            // ini test, memasangkan user dengan nama "Ido Manager" mempunyai 3 role (manager, spv, staff)
            $ido->assignRole('manager');
            $ido->assignRole('spv');
            $ido->assignRole('staff');
            $dani->assignRole('spv');
            // $dani->assignRole('admin'); // {user: 3} {role: 1, permission (4,2,6)}
            // $dani->givePermissionTo('create_konfigurasi/users'); // 3 . 7
            $tika->assignRole('staff');
            // $tika->assignRole('manager');
            /**
             * ini test, memasangkan user dengan nama "Dian Admin" mempunyai role admin juga,
             * jadi yang mempunyai role admin ada  2 orang, "Paga Admin" dan "Dian Admin"
             */

            $dian->assignRole('admin');
            // $ido->givePermissionTo(['read_konfigurasi', 'read_konfigurasi/roles', 'read_konfigurasi/users']);
            // $dani->givePermissionTo(['delete_konfigurasi/users', 'delete_konfigurasi/roles']); // {user: 3} { permission (9,5)}

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
