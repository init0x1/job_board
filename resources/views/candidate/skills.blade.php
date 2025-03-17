@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Select Your Skills</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('candidate.skills') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Choose Your Skills:</label>
                            <select name="skills[]" class="form-select" multiple>
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}" 
                                        {{ in_array($skill->id, $userSkills->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save Skills</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
