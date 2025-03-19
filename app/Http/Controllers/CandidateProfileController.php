<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Profile;

class CandidateProfileController extends Controller
{
    /**
     * Show the candidate profile page.
     */
    public function showSkills()
    {
        return view('candidate.skills');
    }
    

    public function show()
    {
        return view('candidate.profile');
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
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'linkedin_url' => $request->linkedin_url,
                'bio' => $request->bio,
                'resume_path' => $resumePath,
                
            ]
        );

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
