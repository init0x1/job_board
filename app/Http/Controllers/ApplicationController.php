<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{

    // list employer applications
    public function employerApplications(Request $request)
    {
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('error', 'You need to create a company profile first');
        }

        // get all jobs for this company
        $jobIds = JobListing::where('company_id', $company->id)->pluck('id');

        // applications for these jobs
        $query = Application::whereIn('job_id', $jobIds)
            ->with(['job', 'user']);

        // filter by job title
        if ($request->has('job_title') && !empty($request->job_title)) {
            $query->whereHas('job', function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->job_title . '%');
            });
        }


        $validStatuses = ['pending', 'approved', 'rejected'];
        if ($request->has('status')) {
            $requestedStatus = trim($request->status);
            if (empty($requestedStatus)) {
                $query->whereIn('status', $validStatuses);
            }
            elseif (in_array($requestedStatus, $validStatuses)) {
                $query->where('status', $requestedStatus);
            }

            else {
                return redirect()->route('employer.applications')
                    ->with('error', 'Invalid status');
            }
        }

        // Filter by job ID
        if ($request->has('job_id') && !empty($request->job_id)) {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(10);
        $jobs = JobListing::where('company_id', $company->id)->get();

        return view('employer.applications.index', compact('applications', 'jobs'));
    }


    /**
     * Display application details
     */
    public function showEmployerApplication($id)
    {
        $application = Application::with(['job', 'user', 'user.profile'])->findOrFail($id);

        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('error', 'You need to create a company profile first');
        }

        // get all jobs of company
        $jobs = JobListing::where('company_id', $company->id)->pluck('id');

        if (!$jobs->contains($application->job_id)) {
            return redirect()->route('employer.applications')
                ->with('error', 'You do not have permission to view this application');
        }

        return view('employer.applications.show', compact('application'));
    }

    /**
     * Approve an application
     */
    public function approveApplication($id)
    {
        $application = Application::findOrFail($id);

        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('error', 'You need to create a company profile first');
        }

        $jobs = JobListing::where('company_id', $company->id)->pluck('id');

        if (!$jobs->contains($application->job_id)) {
            return redirect()->route('employer.applications')
                ->with('error', 'You do not have permission to approve this application');
        }

        $application->status = 'approved';
        $application->save();

        return redirect()->back()->with('success', 'Application approved successfully');
    }

    /**
     * Reject an application
     */
    public function rejectApplication($id)
    {
        $application = Application::findOrFail($id);

        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('error', 'You need to create a company profile first');
        }

        $jobs = JobListing::where('company_id', $company->id)->pluck('id');

        if (!$jobs->contains($application->job_id)) {
            return redirect()->route('employer.applications')
                ->with('error', 'You do not have permission to reject this application');
        }

        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'Application rejected successfully');
    }

    //we need to implement viewCandidate!

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
        //show error if application not found
        $application = Application::findOrFail($id);

        // Check if the logged-in user owns this application
        if (Auth::id() !== $application->user_id) {
            return abort(403, 'Unauthorized Access');
        }

        return view('globalPages.applications.show', compact('application'));
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
            'website' => 'nullable|url|max:255',
            'cover_letter' => 'required|string',
            'resume_path' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $resume_path = $request->file('resume_path')->store('resumes', 'public');

        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
            'website' => $request->website,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resume_path,
            'status'=>'pending'
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
    // Delete application
    public function destroy($id)
    {
        $application = Application::where('user_id', Auth::id())->findOrFail($id);
        $job = JobListing::findOrFail($application->job_id);

        // Restrict delete if the application is not pending or job deadline has passed
        if ($application->status !== 'pending' || now()->greaterThan($job->application_deadline)) {
            return redirect()->route('candidate.application.index')->with('error', 'You cannot delete this application.');
        }

        $application->delete();

        return redirect()->route('candidate.application.index')->with('success', 'Application deleted successfully!');
    }

}
