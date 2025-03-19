@include('candidate.navbar')


@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Candidate Dashboard</h3>
        </div>
        <div class="card-body text-center">
            <p>Welcome, {{ Auth::user()->name }}!</p>
            <p>Your email: {{ Auth::user()->email }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-success">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
