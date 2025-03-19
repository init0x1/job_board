<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      public function index_user(Request $request)
      {
          $categories = Category::orderBy('name', 'ASC')->get();
          $jobTypes = ['remote', 'hybrid', 'onsite']; // Job types are static
          $locations = Location::orderBy('name', 'ASC')->get();
      
          // Base Query
          $jobs = JobListing::query()->where('status', 'approved')->where('application_deadline', '>=', now());
      
          // Search using keyword
          if (!empty($request->keyword)) {
              $jobs->where(function ($query) use ($request) {
                  $query->where('title', 'like', '%' . $request->keyword . '%')
                        ->orWhere('description', 'like', '%' . $request->keyword . '%');
              });
          }
      
          // Search using location
          if (!empty($request->location)) {
              $jobs->where('location_id', $request->location);
          }
          
          // Search using category
          if (!empty($request->category)) {
              $jobs->where('category_id', $request->category);
          }
      
          // Search using Work Type
          if (!empty($request->work_type)) {
              $jobs->where('work_type', $request->work_type);
          }
      
          // Search using Salary Range
          if (!empty($request->min_salary)) {
              $jobs->where('salary_min', '>=', $request->min_salary);
          }
          if (!empty($request->max_salary)) {
              $jobs->where('salary_max', '<=', $request->max_salary);
          }
          
          // Search using Job Experience
          if (!empty($request->experience)) {
              $jobs->where('experience_level', $request->experience);
          }
      
          // Search using Job Nature
          if (!empty($request->job_nature)) {
              $jobs->where('job_nature', $request->job_nature);
          }
      
          // Filter by Date Posted
          if (!empty($request->date_posted)) {
              if ($request->date_posted == '24_hours') {
                  $jobs->where('created_at', '>=', now()->subDay());
              } elseif ($request->date_posted == 'week') {
                  $jobs->where('created_at', '>=', now()->subWeek());
              } elseif ($request->date_posted == 'month') {
                  $jobs->where('created_at', '>=', now()->subMonth());
              }
          }
      
          // Sorting
          if (!empty($request->sort)) {
              if ($request->sort == '0') {
                  $jobs->orderBy('created_at', 'ASC');
              } else {
                  $jobs->orderBy('created_at', 'DESC');
              }
          } else {
              $jobs->orderBy('created_at', 'DESC'); // Default sorting
          }
      
          $jobs = $jobs->paginate(10);
      
          return view('globalPages.jobs.index', [
              'categories' => $categories,
              'jobs' => $jobs,
              'locations' => $locations
          ]);
      }
      


    
        /**
    * Display the specified resource.
    */
    public function show_user($id)
    {
        $job = JobListing::find($id); // Fetch job by ID
    
        if (!$job) {
            return redirect()->route('user.job.index')->with('error', 'Job not found');
        }
    
        return view('globalPages.jobs.show', compact('job'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobListing::all();
        return view('globalPages.jobs.index', compact('jobs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $job)
    {
        return view('globalPages.jobs.show', compact('job'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $jobListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {
        //
    }
    public function applyJob(Request $request, $id)
    {
        $job = JobListing::find($id);
        $job->applications()->create([
            'user_id' => auth()->id(),
            'expected_salary' => $request->expected_salary,
            'resume' => $request->resume,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully');
    }
    public function saveJob($id)
    {
        $job = JobListing::find($id);
        $job->savedJobs()->attach(auth()->id());

        return redirect()->back()->with('success', 'Job saved successfully');
    }
}
