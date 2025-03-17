<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    /**
     * Show the skills form for candidates.
     */
    public function showSkillsForm()
    {
        return view('candidate.skills', [
            'skills' => Skill::all(), 
            'userSkills' => Auth::user()->profile ? Auth::user()->profile->skills : [],
        ]);
    }

    /**
     * Store candidate skills.
     */
    public function storeSkills(Request $request)
    {
        $request->validate([
            'skills' => 'required|array|min:1', // Ensure at least one skill is selected
            'skills.*' => 'exists:skills,id', // Each skill must exist in the database
        ]);

        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = Profile::create([
                'user_id' => $user->id,
            ]);
        }

        $profile->skills()->sync($request->skills); // Attach selected skills

        return redirect('/home')->with('success', 'Skills updated successfully.');
    }

    /**
     * Show all skills for admin (Optional Feature).
     */
    public function index()
    {
        return view('admin.skills.index', ['skills' => Skill::all()]);
    }

    /**
     * Store a new skill (Admin only).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
        ]);

        Skill::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)), // Generate slug
        ]);

        return redirect()->back()->with('success', 'Skill added successfully.');
    }

    /**
     * Delete a skill (Admin only).
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->back()->with('success', 'Skill deleted successfully.');
    }
} 