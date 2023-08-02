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
            $paga = User::create(array_merge(
                [
                    'name' => 'Paga Admin',
                    'username' => 'paga',
                    'email' => 'useradmin@mail.com',
                ],
                $default_value
            ));
            $ido = User::create(array_merge(
                [
                    'name' => 'Ido Manager',
                    'username' => 'ido',
                    'email' => 'usermanager@mail.com',
                ],
                $default_value
            ));
            $dani = User::create(array_merge(
                [
                    'name' => 'Dani Spv',
                    'username' => 'dani',
                    'email' => 'userspv@mail.com',
                ],
                $default_value
            ));
            $tika = User::create(array_merge(
                [
                    'name' => 'Tika Staff',
                    'username' => 'tika',
                    'email' => 'userstaff@mail.com',
                ],
                $default_value
            ));
            $dian = User::create(array_merge(
                [
                    'name' => 'Dian Admin',
                    'username' => 'dian',
                    'email' => 'dianadmin@mail.com',
                ],
                $default_value
            ));

            // insert data ke table roles
            $role_admin = Role::create(['name' => 'admin']);
            $role_manager = Role::create(['name' => 'manager']);
            $role_spv = Role::create(['name' => 'spv']);
            $role_staff = Role::create(['name' => 'staff']);

            // insert data ke table permissions
            $permision = Permission::create(['name' => 'read permission']);
            $permision = Permission::create(['name' => 'create permission']);
            $permision = Permission::create(['name' => 'update permission']);
            $permision = Permission::create(['name' => 'delete permission']);
            Permission::create(['name' => 'read konfigurasi']);

            /**
             * memasangkan role admin ke permision,
             * data ini akan masuk table role_has_permissions
             * jika permision yang di pasangkan tidak ada di table permision, migration akan gagal. tidak ada pesan error, tatapi data seeder tidak masuk ke database
             */
            $role_admin->givePermissionTo(['read permission', 'read konfigurasi']);
            $role_admin->givePermissionTo('create permission');
            $role_admin->givePermissionTo('update permission');
            $role_admin->givePermissionTo('delete permission');

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
            $tika->assignRole('staff');
            /**
             * ini test, memasangkan user dengan nama "Dian Admin" mempunyai role admin juga,
             * jadi yang mempunyai role admin ada  2 orang, "Paga Admin" dan "Dian Admin"
             */

            $dian->assignRole('admin');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
