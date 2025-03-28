<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    /**
     * Show the skills form.
     */
    public function create()
    {
        return view('candidate.skills');
    }

    /**
     * Store skills for the authenticated candidate.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'linkedin_url' => 'nullable|url',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'required|string',
            'bio' => 'required|string',
            'job_title' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Ensure profile exists
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id], 
            [
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'linkedin_url' => $request->linkedin_url,
                'bio' => $request->bio,
                'resume_path' => $request->file('resume')
                    ? $request->file('resume')->store('resumes', 'public')
                    : null,
                'job_title' => $request->job_title,
            ]
        );

        // Convert skills string into an array & remove empty values
        $skillNames = array_filter(array_map('trim', explode(',', $request->skills)));

        $skillIds = [];

        foreach ($skillNames as $skillName) {
            $skill = Skill::firstOrCreate(
                ['slug' => strtolower(str_replace(' ', '-', $skillName))], 
                ['name' => ucfirst($skillName)]
            );

            $skillIds[] = $skill->id;
        }

        // Attach skills to profile (many-to-many)
        $profile->skills()->sync($skillIds);

        return redirect()->route('dashboard')->with('success', 'Skills updated successfully!');
    }
}
