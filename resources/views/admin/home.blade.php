@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-4">Hello, {{ Auth::user()->name }}</h1>
        <p class="lead">Welcome to our admin dashboard for our medical center. We hope that you will find your way around easily.</p>
        <hr class="my-4">
        <p>Please use the buttons below to navigate or use the navigation above.</p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a class="btn btn-primary btn-lg" href="{{ route('admin.patients.index') }}" role="button">Patients</a>
        <a class="btn btn-primary btn-lg" href="{{ route('admin.doctors.index') }}" role="button">Doctors</a>
        <a class="btn btn-primary btn-lg" href="{{ route('admin.visits.index') }}" role="button">Visits</a>
    </div>
</div>
@endsection
