<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{


    // Show applications user has applied to
    public function showUserApplications()
    {
        $applications = Application::where('user_id', Auth::id())->get();
        return view('globalPages.applications.index', compact('applications'));
    }
    public function showSavedApplications() //not implement yet in views
    {
        $applications = Application::where('user_id', Auth::id())->where('status', 'saved')->get();
        return view('globalPages.applications.saved', compact('applications'));
    }
    // Show single application of single user
    public function showSingleUserApplication($id)
    {
        $application = Application::where('user_id', Auth::id())->findOrFail($id);
        $job = JobListing::findOrFail($application->job_id);

        // Check if the application is pending and the job deadline has not passed
        if ($application->status !== 'pending' || now()->greaterThan($job->application_deadline)) {
            return redirect()->route('candidate.application.index')->with('error', 'You cannot edit this application.');
        }

        return view('globalPages.applications.show', compact('application','job'));
    }

    // create the form to apply for a job
    public function create($jobId)
    {
        $job = JobListing::findOrFail($jobId); // Get job details
        return view('globalPages.applications.create', compact('job'));
    }
    
    // Store the application
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'website' => 'url|max:255',
            'cover_letter' => 'required|string',
            'resume_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);
    
        $user = Auth::user();
        $profile = $user->profile;
    
        // Check if a new resume is uploaded
        if ($request->hasFile('resume_path')) {
            $resume_path = $request->file('resume_path')->store('resumes', 'public');
    
            // Update user's profile resume
            if ($profile) {
                $profile->update(['resume_path' => $resume_path]);
            }
        } else {
            // Use the existing resume from the user's profile
            $resume_path = $profile->resume_path ?? null;
        }
    
        // Create the job application
        Application::create([
            'user_id' => $user->id,
            'job_id' => $jobId,
            'website' => $request->website,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resume_path,
            'status' => 'pending'
        ]);
    
        return redirect()->route('candidate.application.index')->with('success', 'Application submitted successfully!');
    }
    

    public function edit($id)
    {
        $application = Application::where('user_id', Auth::id())->findOrFail($id);
        $job = JobListing::findOrFail($application->job_id);

        // Check if the application is pending and the job deadline has not passed
        if ($application->status !== 'pending' || now()->greaterThan($job->application_deadline)) {
            return redirect()->route('candidate.application.index')->with('error', 'You cannot edit this application.');
        }

        return view('globalPages.applications.edit', compact('application', 'job'));
    }


    // Update application
    public function update(Request $request, $id)
    {
        $application = Application::where('user_id', Auth::id())->findOrFail($id);
        $job = JobListing::findOrFail($application->job_id);

        // Restrict update if the application is not pending or job deadline has passed
        if ($application->status !== 'pending' || now()->greaterThan($job->application_deadline)) {
            return redirect()->route('candidate.application.index')->with('error', 'You cannot update this application.');
        }

        $request->validate([
            'cover_letter' => 'required|string',
            'resume_path' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('resume_path')) {
            $resume_path = $request->file('resume_path')->store('resumes', 'public');
            $application->resume_path = $resume_path;
        }

        $application->cover_letter = $request->cover_letter;
        $application->save();

        return redirect()->route('candidate.application.index')->with('success', 'Application updated successfully!');
    }

    // Save application Draft
    public function SaveApplication($id)//(id,job_id)
    {
        $application = Application::where('user_id', Auth::id())->findOrFail($id);
        $application->status = 'saved';
        $application->save();

        return redirect()->route('candidate.application.index')->with('success', 'Application saved successfully!');
    }


}
