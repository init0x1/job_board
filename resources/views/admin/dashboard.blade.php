@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow-lg p-4">
        <h3>Welcome, {{ Auth::user()->name }} (Admin)!</h3>

        <div class="mt-3">
            @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle" width="150">
            @else
                <img src="{{ asset('default-avatar.png') }}" class="rounded-circle" width="150">
            @endif
        </div>

        <p class="mt-3">Your email: {{ Auth::user()->email }}</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>
@endsection
