<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreJobListingRequest;
use App\Http\Requests\UpdateJobListingRequest;

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
              $jobs->where('location', $request->location);
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
    public function showEmployerJob($id)
    {
        $job = JobListing::findOrFail($id);
        $user = auth()->user();
        
        if (!$user->company || $job->company_id != $user->company->id) {
            return redirect()->route('employer.jobs')->with('error', 'You do not have permission to view this job');
        }
        
        return view('employer.jobs.show', compact('job'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get categories and locations 
        $categories = Category::orderBy('name', 'ASC')->get();
        $locations = Location::orderBy('name', 'ASC')->get();
        
        return view('employer.jobs.create', compact('categories', 'locations'));    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobListingRequest $request)
    {
        $company = auth()->user()->company; 
        $location = Location::find($request->location_id);
        
        // create job
        JobListing::create([
            'user_id' => Auth::id(),
            'company_id' => $company->id,
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'requirements' => $request->requirements,
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'location' => $location->name, 
            'work_type' => $request->work_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'application_deadline' => $request->application_deadline,
            'status' => 'pending' 
        ]);
        
        return redirect()->route('employer.dashboard')->with('success', 'Job created successfully it will be visible after approval');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $job)
    {
        if ($job->company_id != auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $categories = Category::all();
        $locations = Location::all();
    
        return view('employer.jobs.edit', compact('job', 'categories', 'locations'));
    }
    
    public function update(UpdateJobListingRequest $request, JobListing $job)
    {
        if ($job->company_id != auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'requirements' => $request->requirements,
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'work_type' => $request->work_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'application_deadline' => $request->application_deadline,
            'status' => 'pending', 
        ]);
    
        return redirect()->route('employer.jobs')->with('success', 'Job updated successfully. It will need to be re-approved.');
    }

    public function companyJobs(Request $request)
    {
        $company = auth()->user()->company;
        $jobs = JobListing::where('company_id', $company->id)
            ->when($request->status, function($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->search, function($query) use ($request) {
                return $query->where('title', 'like', '%'.$request->search.'%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    
        return view('employer.jobs.index', compact('jobs'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $job)
    {
        if ($job->company_id != auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $job->delete();
    
        return redirect()->route('employer.jobs')
            ->with('success', 'Job deleted successfully.');
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
    public function employerDashboard()
    {
        $user = auth()->user();
        $company = $user->company;
        
        if (!$company) {
            return redirect()->back()->with('error', 'You are not associated with any company');
        }
    
        $jobs = JobListing::where('company_id', $company->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    
        return view('employer.dashboard', compact('jobs', 'company'));
    }
}
