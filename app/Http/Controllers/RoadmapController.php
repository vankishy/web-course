<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roadmap;
use App\Models\UserRoadmap;
use App\Models\Course;

class RoadmapController extends Controller
{
    public function index()
    {
        // Pastikan user login sebelum akses
        $user = auth()->user();
        // $user_id = 1;

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to view your roadmaps.');
        }

        $followedRoadmapIds = $user->roadmaps()
                               ->select('roadmap.roadmap_id') // Tentukan kolom mana yang harus diambil
                               ->pluck('roadmap_id');

        // Ini secara otomatis mengambil semua roadmap yang terhubung dengan user melalui tabel 'user_roadmap'.
        $roadmaps = $user->roadmaps()->get();

        // 3. Ambil Roadmap Rekomendasi (Semua Roadmap yang ID-nya TIDAK ada di followedRoadmapIds)
        $recommendedRoadmaps = Roadmap::whereNotIn('roadmap_id', $followedRoadmapIds)
                                    ->get();

        return view('roadmap.main', compact('roadmaps', 'recommendedRoadmaps'));
    }

    public function show($slug)
    {
        // Menggunakan relasi 'courses' yang baru didefinisikan di Model Roadmap
        $roadmap = Roadmap::where('slug', $slug)
                            ->with('courses') // Eager load semua kursus
                            ->firstOrFail(); 

        return view('roadmap.detail', compact('roadmap'));
    }
}
