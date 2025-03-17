<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Models\Category;
class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexFilterByCategory()
    {
        $jobs = JobListing::all();
        return view('globalPages.jobs.index', compact('jobs'));
    }

    public function index_user(Request $request)
    {
        $category_id = $request->query('category');
        $categories = Category::all();
        //show jobs if  category found

        $jobs = JobListing::when($category_id, function ($query) use ($category_id) {
            return $query->where('category_id', $category_id);
        })->get();

        //show error when  category not found or empty
        // but when select all cat it sow no query search
        if ($jobs->isEmpty() && !$categories->where('id', $category_id)->first()) {
            return view('globalPages.jobs.index', compact('jobs', 'categories'))
                ->with('error', 'No jobs available in this category.');
        }

        return view('globalPages.jobs.index', compact('jobs', 'categories'));
    }

    /**
     * Display the specified resource.
     */

    public function show_user(JobListing $job)
    {

        if (!$job) {
            abort(404);
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
}
