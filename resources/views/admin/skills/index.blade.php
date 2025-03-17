@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Skills</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h5>Add New Skill</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.skills') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Skill Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Add Skill</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-dark text-white">
                    <h5>Existing Skills</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($skills as $skill)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $skill->name }}
                            <form method="POST" action="{{ url('/admin/skills/'.$skill->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
