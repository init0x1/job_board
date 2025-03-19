<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of candidates.
     */
    public function index_user()
    {
        $candidates = User::where('role', 'candidate')->with('profile')->get();
        return view('globalPages.candidates.index', compact('candidates'));
    }

    /**
     * Display a single candidate profile.
     */
    public function show_user($id)
    {
        $candidate = User::where('role', 'candidate')->with('profile')->findOrFail($id);
        return view('globalPages.candidates.show', compact('candidate'));
    }
    public function index()
    {
        //
    }

    /**
     * Display a single candidate profile.
     */
    public function show($id)
    {
        //
    }
}
