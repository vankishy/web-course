<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\DetailCourse;
use App\Models\WatchLater;
use App\Models\Course;
use App\Models\SubCourse;
use PHPUnit\Framework\Attributes\Test; // BARU: Untuk sintaks modern

class WatchLaterTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $otherUser;
    private $detailCourse;
    private $detailCourse2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
        $this->detailCourse = DetailCourse::factory()->create(['name' => 'Test Materi 1']);
        $this->detailCourse2 = DetailCourse::factory()->create(['name' => 'Test Materi 2']);
    }

    #[Test] // DIPERBARUI
    public function guests_cannot_access_watch_later_routes()
    {
        $this->get(route('watchlater.index'))->assertRedirect(route('signin'));
        $this->post(route('watchlater.store'))->assertRedirect(route('signin'));
        $this->delete(route('watchlater.destroy', 1))->assertRedirect(route('signin'));
    }

    #[Test] // DIPERBARUI
    public function user_can_add_an_item_to_their_watch_later_list()
    {
        $this->actingAs($this->user)
            ->post(route('watchlater.store'), [
                'detail_course_id' => $this->detailCourse->detail_course_id
            ]);

        $this->assertDatabaseHas('watchlater', [
            // PERBAIKAN: Menggunakan user_id
            'user_id' => $this->user->user_id, 
            'detail_course_id' => $this->detailCourse->detail_course_id
        ]);
    }

    #[Test] // DIPERBARUI
    public function user_can_see_their_own_watch_later_list()
    {
        WatchLater::factory()->create([
            // PERBAIKAN: Menggunakan user_id
            'user_id' => $this->user->user_id, 
            'detail_course_id' => $this->detailCourse->detail_course_id
        ]);
        
        WatchLater::factory()->create([
            // PERBAIKAN: Menggunakan user_id
            'user_id' => $this->otherUser->user_id, 
            'detail_course_id' => $this->detailCourse2->detail_course_id
        ]);

        $response = $this->actingAs($this->user)->get(route('watchlater.index'));
        
        $response->assertStatus(200);
        $response->assertSee($this->detailCourse->name);
        $response->assertDontSee($this->detailCourse2->name);
    }

    #[Test] // DIPERBARUI
    public function user_can_delete_their_own_item()
    {
        $item = WatchLater::factory()->create([
            // PERBAIKAN: Menggunakan user_id
            'user_id' => $this->user->user_id, 
            'detail_course_id' => $this->detailCourse->detail_course_id
        ]);

        $this->actingAs($this->user)
            ->delete(route('watchlater.destroy', $item->watchlater_id));
        
        $this->assertSoftDeleted('watchlater', [
            'watchlater_id' => $item->watchlater_id
        ]);
    }

    #[Test] // DIPERBARUI
    public function user_cannot_delete_another_users_item()
    {
        $itemOrangLain = WatchLater::factory()->create([
            // PERBAIKAN: Menggunakan user_id
            'user_id' => $this->otherUser->user_id, 
            'detail_course_id' => $this->detailCourse->detail_course_id
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('watchlater.destroy', $itemOrangLain->watchlater_id));

        $response->assertStatus(403); 

        $this->assertDatabaseHas('watchlater', [
            'watchlater_id' => $itemOrangLain->watchlater_id
        ]);
    }
}