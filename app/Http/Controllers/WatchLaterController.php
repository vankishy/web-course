<?php

namespace App\Http\Controllers;

use App\Models\WatchLater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchLaterController extends Controller
{
    /**
     * Display the user's watch later list.
     */
   public function index(Request $request) // <-- Tambahkan 'Request $request'
    {
        // 1. Ambil parameter 'sort' dari URL, default-nya 'newest'
        $sort = $request->input('sort', 'newest');

        // 2. Mulai kueri
        $userId = Auth::id();
        $query = WatchLater::where('user_id', $userId)
                    ->with('detailCourse.subcourse.course'); // Tetap gunakan eager loading

        // 3. Terapkan logika pengurutan
        switch ($sort) {
            case 'oldest':
                // Urutkan berdasarkan data terlama
                $query->orderBy('created_at', 'asc');
                break;
            case 'alphabetical':
                // Untuk mengurutkan berdasarkan abjad, kita perlu 'join'
                // dengan tabel 'detail_course' dan urutkan berdasarkan 'name'.
                $query->join('detail_course', 'watchlater.detail_course_id', '=', 'detail_course.detail_course_id')
                      ->orderBy('detail_course.name', 'asc')
                      ->select('watchlater.*'); // Penting: Pilih kolom watchlater agar tidak bentrok
                break;
            case 'newest':
            default:
                // Urutkan berdasarkan data terbaru (default)
                $query->orderBy('created_at', 'desc');
                break;
        }

        // 4. Eksekusi kueri
        $watchLaterItems = $query->get();

        // 5. Kirim data dan nilai 'sort' saat ini ke view
        return view('watchlater', [
            'watchLaterItems' => $watchLaterItems,
            'currentSort' => $sort // <-- Kirim variabel ini ke view
        ]);
    }

    /**
     * Add a detail_course item to the user's watch later list.
     */
    public function store(Request $request)
    {
        // Validate that the detail_course_id is provided and exists
        $request->validate([
            'detail_course_id' => 'required|exists:detail_course,detail_course_id'
        ]);

        // Use firstOrCreate to avoid adding duplicates
        WatchLater::firstOrCreate([
            'user_id' => Auth::id(),
            'detail_course_id' => $request->detail_course_id
        ]);

        return back()->with('success', 'Item added to your Watch Later list!');
    }

    /**
     * Remove an item from the user's watch later list.
     */
    public function destroy(WatchLater $watchLater)
    {
        // Authorize: Make sure the user owns this item before deleting
        if ($watchLater->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $watchLater->delete();

        return back()->with('success', 'Item removed from your Watch Later list.');
    }
}