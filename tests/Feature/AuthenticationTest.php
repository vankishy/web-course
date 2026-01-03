<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    // =================================================================
    // TEST REGISTRASI (SIGN UP)
    // =================================================================

    #[Test]
    public function halaman_signup_dapat_ditampilkan()
    {
        $response = $this->get(route('signup'));
        $response->assertStatus(200);
    }

    #[Test]
    public function pengguna_baru_dapat_mendaftar()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        
        // PENTING: Tes ini akan gagal jika validasi 'confirmed'
        // dan 'unique:user' belum diperbaiki di AuthControllers.
        $response = $this->post(route('register.process'), $userData);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('user', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->assertGuest();
        $response->assertRedirect(route('signin'));
        $response->assertSessionHas('success');
    }

    #[Test]
    public function registrasi_gagal_jika_email_sudah_ada()
    {
        // 1. Buat user dummy terlebih dahulu
        User::factory()->create(['email' => 'test@example.com']);

        // 2. Coba daftar lagi dengan email yang sama
        $response = $this->post(route('register.process'), [
            'name' => 'User Kedua',
            'email' => 'test@example.com', // Email yang sudah ada
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // 3. Tes mengharapkan ada error validasi di field 'email'
        //    Ini yang akan GAGAL karena controller Anda memeriksa 'unique:users'
        $response->assertSessionHasErrors('email');

        // 4. Pastikan pengguna TIDAK terautentikasi
        $this->assertGuest();
    }


    // =================================================================
    // TEST LOGIN (SIGN IN)
    // =================================================================

    #[Test]
    public function halaman_signin_dapat_ditampilkan()
    {
        $response = $this->get(route('signin'));
        $response->assertStatus(200);
    }

    #[Test]
    public function pengguna_dapat_login_dengan_kredensial_yang_benar()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login.process'), [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard'));
    }

    #[Test]
    public function pengguna_tidak_dapat_login_dengan_password_salah()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login.process'), [
            'email' => 'user@example.com',
            'password' => 'password_salah',
        ]);

        $this->assertGuest();
        $response->assertSessionHas('error', 'Email atau Password salah.');
        $response->assertRedirect(route('signin'));
    }

    // =================================================================
    // TEST LOGOUT
    // =================================================================

    #[Test]
    public function pengguna_yang_sudah_login_dapat_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('signin'));
    }
}