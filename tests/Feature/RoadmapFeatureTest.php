<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Roadmap;
use App\Models\Course;

class RoadmapFeatureTest extends TestCase
{
    // 💡 Trait ini akan me-reset database Anda setelah setiap pengujian.
    // Pastikan Anda telah mengkonfigurasi database pengujian terpisah di file .env.testing atau phpunit.xml
    use RefreshDatabase;

    /**
     * @test
     * Skenario 1: Pengguna BELUM Login (Guest)
     * Menguji bahwa tamu akan diarahkan ke halaman login.
     */
    public function test_guest_cannot_access_roadmap_detail_page()
    {
        // Arrange (Persiapan): Kita hanya perlu slug
        $slug = 'frontend-developer';

        // Act (Aksi): Coba akses rute sebagai tamu
        $response = $this->get('/roadmap/' . $slug);

        // Assert (Hasil):
        // 1. Pastikan respons adalah 'Redirect' (302)
        // 2. Pastikan pengguna diarahkan ke rute 'signin' (sesuai web.php Anda)
        $response->assertStatus(302);
        $response->assertRedirect(route('signin'));
    }

    /**
     * @test
     * Skenario 2 & 3: Pengguna SUDAH Login, Data Ditemukan (Happy Path)
     * Menguji rute, status 200, dan data dari database.
     */
    // public function test_authenticated_user_can_see_roadmap_detail_with_courses()
    // {
    //     // == ARRANGE (PERSIAPAN) ==

    //     // 1. Buat satu pengguna palsu (fake user)
    //     $user = User::factory()->create();

    //     // 2. Buat Roadmap 'Frontend Developer'
    //     // Kita harus membuat data ini agar halaman bisa ditemukan
    //     $roadmap = Roadmap::factory()->create([
    //         'name' => 'Frontend Developer Roadmap',
    //         'slug' => 'frontend-developer',
    //     ]);

    //     // 3. Buat beberapa Course
    //     $course1 = Course::factory()->create(['name' => 'Belajar HTML Dasar']);
    //     $course2 = Course::factory()->create(['name' => 'Belajar CSS Modern']);

    //     // 4. Hubungkan Course ke Roadmap (mengisi tabel pivot 'roadmap_course')
    //     // Ini adalah bagian PENTING untuk poin 3b Anda
    //     $roadmap->courses()->attach([
    //         $course1->course_id,
    //         $course2->course_id
    //     ]);


    //     // == ACT (AKSI) ==
    //     // 1. "Login" sebagai pengguna yang baru dibuat
    //     // 2. Lakukan GET request ke rute
    //     $response = $this->actingAs($user)
    //                      ->get('/roadmap/frontend-developer');


    //     // == ASSERT (HASIL) ==
    //     // Poin 3a: Memastikan halaman 200 OK
    //     $response->assertStatus(200);

    //     // Poin 3b: Memastikan data dari database TAMPIL di halaman
    //     $response->assertSee('Frontend Developer Roadmap'); // Cek nama roadmap
    //     $response->assertSee('Belajar HTML Dasar');         // Cek nama course 1
    //     $response->assertSee('Belajar CSS Modern');         // Cek nama course 2

    //     // Bonus: Pastikan view yang benar dimuat
    //     $response->assertViewIs('roadmap.detail');
    // }


    /**
     * @test
     * Skenario 4: Pengguna SUDAH Login, Data TIDAK Ditemukan (Sad Path)
     * Menguji apa yang terjadi jika slug-nya salah (harus 404).
     */
    public function test_authenticated_user_gets_404_for_invalid_slug()
    {
        // Arrange (Persiapan): Buat pengguna dan login
        $user = User::factory()->create();

        // Act (Aksi): Coba akses rute dengan slug yang tidak ada di database
        $response = $this->actingAs($user)
                         ->get('/roadmap/slug-yang-pasti-tidak-ada');

        // Assert (Hasil):
        // Controller Anda menggunakan firstOrFail(), jadi ini harus 404 Not Found
        $response->assertStatus(404);
    }
}