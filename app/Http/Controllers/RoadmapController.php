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
        $user = auth()->user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in to view your roadmaps.');
        }

        $followedRoadmapIds = $user->roadmaps()
                               ->select('roadmap.roadmap_id')
                               ->pluck('roadmap_id');

        $roadmaps = $user->roadmaps()->get();
        $recommendedRoadmaps = Roadmap::whereNotIn('roadmap_id', $followedRoadmapIds)
                                    ->get();

        return view('roadmap.main', compact('roadmaps', 'recommendedRoadmaps'));
    }

    public function show($slug)
    {
        $roadmap = Roadmap::where('slug', $slug)
                            ->with('courses')
                            ->firstOrFail(); 

        return view('roadmap.detail', compact('roadmap'));
    }
}
