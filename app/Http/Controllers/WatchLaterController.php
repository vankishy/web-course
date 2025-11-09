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
    public function index()
    {
        // --- HAPUS BLOK DATA DUMMY ---
        // (Seluruh kode data dummy yang sebelumnya ada di sini telah dihapus)
        // --- AKHIR DARI BLOK YANG DIHAPUS ---

        // Aktifkan kode database yang asli:
        $userId = Auth::id();
        $watchLaterItems = WatchLater::where('user_id', $userId)
            ->with('detailCourse.subcourse.course') // Eager loading untuk relasi
            ->orderBy('created_at', 'desc') // Tampilkan yang terbaru di atas
            ->get();
        

        // Kirim data asli dari database ke view
        return view('watchlater', [
            'watchLaterItems' => $watchLaterItems
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