@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2>Choose Your Role</h2>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form action="{{ route('select.role') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="candidate">
                <button type="submit" class="btn btn-primary w-100 p-3">Candidate</button>
            </form>
        </div>
        <div class="col-md-4">
            <form action="{{ route('select.role') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="employer">
                <button type="submit" class="btn btn-success w-100 p-3">Employer</button>
            </form>
        </div>
    </div>
</div>
@endsection
