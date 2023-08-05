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
                    'email' => 'useradmin@mail.com',
                ],
                $default_value
            ));
            $ido = User::create(array_merge( // 2
                [
                    'name' => 'Ido Manager',
                    'username' => 'ido',
                    'email' => 'usermanager@mail.com',
                ],
                $default_value
            ));
            $dani = User::create(array_merge( // 3
                [
                    'name' => 'Dani Spv',
                    'username' => 'dani',
                    'email' => 'userspv@mail.com',
                ],
                $default_value
            ));
            $tika = User::create(array_merge( // 4
                [
                    'name' => 'Tika Staff',
                    'username' => 'tika',
                    'email' => 'userstaff@mail.com',
                ],
                $default_value
            ));
            $dian = User::create(array_merge( // 5
                [
                    'name' => 'Dian Admin',
                    'username' => 'dian',
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
