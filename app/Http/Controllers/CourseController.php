<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use App\Models\UserCourseHistory;
use App\Models\UserCourseProgress;
use DB;
use Exception;
use Hash;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::all();
            return view('course.course', compact('courses'));
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    public function subcourse($id)
    {
        try {
            $data = Course::with('subcourse')->find($id);

            if (!$data) {
                abort(404);
            }

            return view('course.main', [
                'data' => $data
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    public function details($subcourseid, Request $request)
    {
        try {
            $userID = 1;
            $data = SubCourse::with(['course', 'detailcourse'])
                ->findOrFail($subcourseid);

            $currentId = $request->query('detail');
            $currentDetail = null;
            $statuscourse = null;

            // kalau ada query 'detail', coba cari di relasi detailcourse
            if ($currentId) {
                $currentDetail = $data->detailcourse->firstWhere('detail_course_id', $currentId);

                // kalau ID-nya gak valid, redirect ke default (materi pertama)
                if (!$currentDetail) {
                    return redirect()->route('course.details', [
                        'id' => $subcourseid,
                        'detail' => optional($data->detailcourse->first())->detail_course_id
                    ])->with('warning', 'Materi yang kamu akses tidak ditemukan, dialihkan ke materi pertama.');
                }
            } else {
                // default ke materi pertama
                $currentDetail = $data->detailcourse->first();
            }

            // Cek status progress user
            $statuscourse = null;
            if ($currentDetail) {
                $statuscourse = UserCourseProgress::where('user_id', $userID)
                    ->where('detail_course_id', $currentDetail->detail_course_id)
                    ->value('done');
                // ->first();
            }

            $this->userhistory($currentDetail->detail_course_id);

            return view('course.details', [
                'data' => $data,
                'currentDetail' => $currentDetail,
                'statuscourse' => $statuscourse,
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function userhistory(int $detailID)
    {
        DB::beginTransaction();
        try {
            $userID = 1;

            UserCourseHistory::updateOrCreate(
                ['user_id' => $userID, 'detail_course_id' => $detailID],
                ['last_seen' => now()]
            );

            Db::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }

    public function markdone($detailID, Request $request)
    {
        DB::beginTransaction();
        try {
            $userID = 1;
            UserCourseProgress::updateOrCreate(
                ["user_id" => $userID, 'detail_course_id' => $detailID],
                ["done" => true]
            );
            DB::commit();
            return back()->with('success', 'Materi ditandai selesai!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menandai progress: ' . $e->getMessage());
        }
    }

    public function createuser(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|string|min:8|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|max:32',
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            DB::commit();

            return response()->json([
                'message' => 'User berhasil dibuat.'
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "gagal: " . $e->getMessage()
            ], 500);
        }
    }
}
