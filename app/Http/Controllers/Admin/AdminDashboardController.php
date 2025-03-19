<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JobListing;
use Illuminate\Support\Facades\Hash;


class AdminDashboardController extends Controller
{

    public function index(){
        // staticts

        // users
        $userStats = [
            'total' => User::count(),
            'employers' => User::where('role', 'employer')->count(),
            'candidates' => User::where('role', 'candidate')->count(),
            'admins' => User::where('role', 'admin')->count(),
        ];
        // jobs
        $jobStats = [
            'total' => JobListing::count(),
            'pending' => JobListing::where('status', 'pending')->count(),
            'approved' => JobListing::where('status', 'approved')->count(),
            'rejected' => JobListing::where('status', 'rejected')->count(),
        ];
        return view('admin.dashboard', compact('userStats', 'jobStats'));

    }

    // listing all the users
    public function listUsers($role)
    {
        if($role == 'all'){
            $users = User::paginate(10);
        }else{
            $users = User::where('role', $role)->paginate(10);
        }
        return view('admin.users.list', compact('users', 'role'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.users.list', ['role' => $user->role])
            ->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile) {
            $user->profile->delete();
        }

        if ($user->company) {
            $user->company->delete();
        }

        $user->delete();

        return redirect()->route('admin.users.list', ['role' => $user->role])
            ->with('success', 'User deleted successfully.');
    }

    // Fetch all jobs based on status
    public function listJobs($status, Request $request)
    {
        //validate the status
        $validStatuses = ['all', 'pending', 'approved', 'rejected'];


        if (!in_array($status, $validStatuses)) {
            abort(404, 'Invalid job status.');
        }

        $query = JobListing::query();

        // Filter by status if not 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Search by job title
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by work type
        if ($request->has('work_type') && $request->work_type) {
            $query->where('work_type', $request->work_type);
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($status === 'approved') {
            $query->withCount(['applications' => function ($query) {
                $query->where('status', 'approved');
            }]);
        }

        $jobs = $query->paginate(10);

        return view('admin.jobs.list', compact('jobs', 'status'));
    }

    public function editJob($id)
    {
        $job = JobListing::withCount(['applications' => function ($query) {
            $query->where('status', 'approved');
        }])->findOrFail($id);

        return view('admin.jobs.edit', compact('job'));
    }

    public function deleteJob($id)
    {
        $job = JobListing::findOrFail($id);

        $job->delete();

        return redirect()->route('admin.jobs.list', ['status' => 'all'])
            ->with('success', 'Job deleted successfully.');
    }

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
