<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AuthenticationAndRolesTest extends TestCase
{
    use RefreshDatabase;

    /** Memastikan halaman awal dan autentikasi dapat dibuka oleh pengunjung. */
    public function test_guest_can_view_the_home_login_and_registration_pages(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('login'))->assertOk();
        $this->get(route('register'))->assertOk();
    }

    /** Memastikan pendaftaran membuat customer walau request mengirim role lain. */
    public function test_registration_creates_and_authenticates_a_customer_only(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Rina Customer',
            'email' => 'rina@example.com',
            'password' => 'StrongPass123',
            'password_confirmation' => 'StrongPass123',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'rina@example.com',
            'role' => 'customer',
        ]);
    }

    /** Memastikan pendaftaran gagal jika konfirmasi password tidak cocok. */
    public function test_registration_rejects_mismatched_password_confirmation(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Rina Customer',
            'email' => 'rina@example.com',
            'password' => 'StrongPass123',
            'password_confirmation' => 'DifferentPass123',
        ])->assertSessionHasErrors('password');

        $this->assertDatabaseMissing('users', ['email' => 'rina@example.com']);
        $this->assertGuest();
    }

    /** Memastikan login berhasil dan mengarahkan admin ke dashboard yang tepat. */
    public function test_user_can_log_in_and_is_redirected_to_their_role_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'StrongPass123',
            'role' => 'admin',
        ]);

        $this->post(route('login.store'), [
            'email' => 'admin@example.com',
            'password' => 'StrongPass123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
        $this->get(route('dashboard'))->assertRedirect(route('admin.dashboard'));
        $this->get(route('admin.dashboard'))->assertOk()->assertSee('Administrator');
    }

    /** Memastikan kredensial salah tidak membuat pengguna masuk. */
    public function test_invalid_credentials_do_not_authenticate_the_user(): void
    {
        User::factory()->create(['email' => 'rina@example.com']);

        $this->post(route('login.store'), [
            'email' => 'rina@example.com',
            'password' => 'incorrect-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    /** Memastikan pengguna dapat keluar dari akunnya. */
    public function test_user_can_log_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    #[DataProvider('roleDashboardCases')]
    /** Memastikan setiap role dapat membuka dashboard miliknya. */
    public function test_each_role_can_open_its_own_dashboard(string $role, string $route): void
    {
        $this->actingAs(User::factory()->create(['role' => $role]))
            ->get(route($route))
            ->assertOk();
    }

    #[DataProvider('forbiddenRoleDashboardCases')]
    /** Memastikan role ditolak dari dashboard milik role lain. */
    public function test_role_cannot_open_another_roles_dashboard(string $role, string $route): void
    {
        $this->actingAs(User::factory()->create(['role' => $role]))
            ->get(route($route))
            ->assertForbidden();
    }

    /** Menyediakan pasangan role dan route dashboard yang diizinkan. */
    public static function roleDashboardCases(): array
    {
        return [
            'admin dashboard' => ['admin', 'admin.dashboard'],
            'petugas dashboard' => ['petugas', 'petugas.dashboard'],
            'customer dashboard' => ['customer', 'customer.dashboard'],
        ];
    }

    /** Menyediakan pasangan role dan route dashboard yang harus ditolak. */
    public static function forbiddenRoleDashboardCases(): array
    {
        return [
            'admin cannot open petugas dashboard' => ['admin', 'petugas.dashboard'],
            'admin cannot open customer dashboard' => ['admin', 'customer.dashboard'],
            'petugas cannot open admin dashboard' => ['petugas', 'admin.dashboard'],
            'petugas cannot open customer dashboard' => ['petugas', 'customer.dashboard'],
            'customer cannot open admin dashboard' => ['customer', 'admin.dashboard'],
            'customer cannot open petugas dashboard' => ['customer', 'petugas.dashboard'],
        ];
    }
}
