<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * test di bash dengan
     * php artisan test --filter testCanShowRolePage (memanggil spesifik Function)
     * php artisan test --filter RoleTest (memanggil dengan nama Class)
     *
     * @return void
     */
    // function 1, membuat skenario fuction yang bisa akses ke halaman Roles
    public function testCanShowRolePage()
    {
        // mengambil 1 user random dengan role admin
        /**
         * test akan passed jika menggunakan role admin
         */
        $user = User::role('admin')->get()->random();

        /**
         * test akan failed jika menggunakan role spv, menggembalikan status 403... sama seperti jika di akses langsung ke halaman
         * karena di controller RoleController method index, terdapat authorize "$this->authorize('read permission')"
         * yang artinya, hanya user yang mempunyai permission "read permission saja yang bisa membuka halaman tersebut"
         */
        // $user = User::role('spv')->get()->random();

        // dd($user);

        // menetapkan pengguna yang saat ini masuk untuk aplikasi, di set ke session
        $this->actingAs($user);

        // Kunjungi URI yang diberikan dengan permintaan GET.
        $response = $this->get('/roles');
        // expection respose
        $response->assertStatus(200);
    }

    // function 2, membuat skenario fuction yang tidak bisa akses ke halaman Roles
    public function testCannotShowRolePage()
    {
        // mengambil 1 user random dengan role manager
        /**
         * test akan passed jika menggunakan role selain admin
         */
        $user = User::role('manager')->get()->random();

        // dd($user);

        // menetapkan pengguna yang saat ini masuk untuk aplikasi, di set ke session
        $this->actingAs($user);

        // Kunjungi URI yang diberikan dengan permintaan GET.
        $response = $this->get('/roles');
        // expection respose
        $response->assertStatus(403);
    }

    // function 3, membuat skenario yang tidak bisa akses ke halaman Roles saat belum login
    public function testCannotShowRolePageWhenNotLogin()
    {
        // Kunjungi URI yang diberikan dengan permintaan GET.
        $this->get('/roles')
            // expection akan di redirect jika belum login
            ->assertRedirect('login')
            // expection akan di redirect dan di beri status 302
            ->assertStatus(302);
    }

    // function 4, membuat skenario yang bisa akses ke controller create (method create di RoleController)
    public function testCanShowCreateRolePage()
    {
        /**
         * test akan passed jika menggunakan role admin
         */
        $user = User::role('admin')->get()->random();

        // menetapkan pengguna yang saat ini masuk untuk aplikasi, di set ke session
        $this->actingAs($user);

        // Kunjungi URI yang diberikan dengan permintaan GET.
        $response = $this->get('/roles/create');
        // expection respose ok atau http code 200
        $response->assertOk();
    }

    // function 5, membuat skenario yang tidak bisa akses ke controller create (method create di RoleController)
    public function testCannotShowCreateRolePage()
    {
        /**
         * test akan passed jika menggunakan role selain admin
         */
        $user = User::role('staff')->get()->random();

        // menetapkan pengguna yang saat ini masuk untuk aplikasi, di set ke session
        $this->actingAs($user);

        // Kunjungi URI yang diberikan dengan permintaan GET.
        $response = $this->get('/roles/create');
        // expection respose
        $response->assertStatus(403)
            ->assertSeeText('action is unauthorized'); // tambahan saja

    }

    // function 6, membuat skenario yang tidak bisa akses ke halaman Roles saat belum login
    public function testCannotShowCreateRolePageWhenNotLogin()
    {
        // Kunjungi URI yang diberikan dengan permintaan GET.
        $this->get('/roles/create')
            // expection akan di redirect jika belum login
            ->assertRedirect('login')
            // expection akan di redirect dan di beri status 302
            ->assertStatus(302);
    }
}
