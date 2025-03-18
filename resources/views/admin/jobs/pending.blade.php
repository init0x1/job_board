@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Pending Job Listings</h2>
@endsection

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="alert alert-success mb-4">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                    @endif

                    <!-- Check if there are pending job listings -->
                    @if ($pendingJobs->isEmpty())
                        <p class="text-gray-600 text-center py-4">No pending job listings found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Company</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Work Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Posted On</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pendingJobs as $job)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $job->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $job->company->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $job->location }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $job->work_type == 'remote' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst($job->work_type) }}
                                                </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $job->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex space-x-2">
                                                <!-- Approve Button -->
                                                <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-1 px-3 rounded flex items-center">
                                                        <i class="bi bi-check-circle mr-1"></i> Approve
                                                    </button>
                                                </form>

                                                <!-- Reject Button -->
                                                <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded flex items-center">
                                                        <i class="bi bi-x-circle mr-1"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links -->
                        <div class="mt-4 flex justify-center">
                            {{ $pendingJobs->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
