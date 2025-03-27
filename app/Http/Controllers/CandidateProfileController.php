<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;

class CandidateProfileController extends Controller
{
    /**
     * Show the candidate profile page.
     */
    public function show()
    {
        return view('candidate.profile');
    }

    public function showSkills()
    {
        return view('candidate.skills');
    }

    /**
     * Update candidate profile information.
     */
    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'bio' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'required|string',
        ]);

        $user = Auth::user();

        // Update user basic info
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($user->profile && $user->profile->resume_path) {
                Storage::delete('public/' . $user->profile->resume_path);
            }

            // Store new resume
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            $resumePath = $user->profile->resume_path ?? null;
        }

        // Update or create the user's profile
        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'linkedin_url' => $request->linkedin_url,
                'bio' => $request->bio,
                'resume_path' => $resumePath,
            ]
        );

        // Process skills
        $skills = explode(',', $request->skills);
        $skillIds = [];

        foreach ($skills as $skillName) {
            $skillName = trim($skillName); // Remove unwanted spaces
            $slug = Str::slug($skillName);

            // Check if skill already exists
            $skill = Skill::where('slug', $slug)->orWhere('name', $skillName)->first();

            if (!$skill) {
                $skill = Skill::create([
                    'slug' => $slug,
                    'name' => $skillName,
                ]);
            }

            $skillIds[] = $skill->id;
        }

        // Ensure profile exists before using it
        if ($profile) {
            $profile->skills()->sync($skillIds);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update candidate profile picture.
     */
    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Delete old image if it exists
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }

        // Store new image in `storage/app/public/user_images`
        $imagePath = $request->file('image')->store('user_images', 'public');

        // Update user image path in DB
        $user->update(['image' => $imagePath]);

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
}
