<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fungsi ini hanya perlu menampilkan view landing page
        return view('landingpage');
    }
}