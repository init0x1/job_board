<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobListing;


class AdminDashboardController extends Controller
{
    // Fetch all job listings with status 'pending'
    public function pendingJobs()
    {
        $pendingJobs = JobListing::where('status', 'pending')
            ->with('company')
            ->paginate(10);

        return view('admin.jobs.pending', compact('pendingJobs'));
    }

    // Approve job
    public function approveJob(JobListing $job){
        $job->update(['status' => 'approved']);
        return redirect()->route('admin.jobs.pending')->with('success', 'Job listing approved successfully.');
    }

    // reject job
    public function rejectJob(JobListing $job)
    {
        // Update the job status to 'rejected'
        $job->update(['status' => 'rejected']);

        // Redirect back with a success message
        return redirect()->route('admin.jobs.pending')->with('success', 'Job listing rejected successfully.');
    }

}
