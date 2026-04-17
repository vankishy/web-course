<?php

namespace Tests\Feature;

use App\Models\User; // <-- Tambahkan ini
use Illuminate\Foundation\Testing\RefreshDatabase; // <-- Ini "sihir" migrasi
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase; // <-- Mengaktifkan migrasi otomatis

    /**
     * Tes Skenario 1: Pengguna tamu (guest) tidak bisa mengakses /profile.
     * Mereka harus dialihkan ke halaman signin.
     */
    public function test_guests_cannot_see_profile_page(): void
    {
        // 1. Coba akses URL /profile (dari web.php)
        $response = $this->get('/profile');

        // 2. Pastikan kita dialihkan ke /signin (berdasarkan grup 'guest' di web.php)
        $response->assertRedirect('/signin');
    }

    /**
     * Tes Skenario 2: Pengguna yang sudah login bisa melihat halaman profil mereka.
     */
    public function test_authenticated_user_can_see_their_profile_page(): void
    {
        // 1. SETUP: Buat satu pengguna palsu di database memori
        $user = User::factory()->create();

        // 2. EKSEKUSI: Login sebagai pengguna itu dan akses /profile
        $response = $this->actingAs($user)->get('/profile'); // URL dari web.php

        // 3. ASSERT (Pastikan hasilnya benar)
        
        // Pastikan halaman merespons OK (bukan 404 atau 500)
        $response->assertStatus(200); 

        // Pastikan Controller mengembalikan view 'profile' (dari ProfileController.php)
        $response->assertViewIs('profile'); 

        // Pastikan kita bisa melihat nama pengguna di halaman (dari profile.blade.php)
        $response->assertSee($user->name); 

        // Pastikan kita melihat tanggal join (dari profile.blade.php)
        $response->assertSee($user->created_at->format('F Y'));

        // Pastikan kita melihat teks default (karena kita tidak membuat data UserProfile)
        $response->assertSee('Location not set'); // dari profile.blade.php
        $response->assertSee('No biography provided.'); // dari profile.blade.php

        // Pastikan kita melihat teks default aktivitas (karena kita tidak membuat UserCourseHistory)
        $response->assertSee('No recent learning activity found.'); // dari profile.blade.php
    }
}