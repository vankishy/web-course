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
        // $user = auth()->user(); Buka kalau sudah bisa terhubung via database
        $user_id = 1;

        /*if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to view your roadmaps.');
        }*/

        // Ambil roadmap milik user yang sedang login + relasi course
        // $roadmaps = $user->roadmaps()->with('course')->get(); Buka kalau sudah bisa terhubung via database

        $roadmapIds = \App\Models\UserRoadmap::where('user_id', $user_id)
                    ->pluck('roadmap_id');

        $roadmaps = \App\Models\Roadmap::whereIn('roadmap_id', $roadmapIds)->get();

        // return view('roadmap.main', compact('roadmaps')); Buka kalau sudah bisa terhubung via database
        return view('roadmap.main', compact('roadmaps'));
    }
}
