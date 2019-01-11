@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="display-4">Doctor: {{ $doctor->user->name }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-hover table-striped table-bordered">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $doctor->user->name }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $doctor->address }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $doctor->phone }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $doctor->user->email }}</td>
            </tr>
            <tr>
            <tr>
                <td>date started working</td>
                <td>{{ date("d M Y", strtotime($doctor->started_working)) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="row align-items-center mt-5 mb-3">
        <div class="col-6">
            <h3>Visits</h3>
        </div>
        <div class="col-6">
            <a href="{{ route('admin.visits.create') }}" class="btn btn-primary btn-md float-right">Add Visit</a>
        </div>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Cost</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctor->visits as $visit)
            <tr>
                <td>{{ $visit->patient->user->name }}</td>
                <td>{{ date("d M Y", strtotime($visit->date)) }}</td>
                <td>{{ date("h:i a", strtotime($visit->time)) }}</td>
                <td>{{ $visit->duration }} minutes</td>
                <td>€{{ $visit->cost }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.visits.show', $visit) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('admin.visits.edit', $visit) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.visits.destroy', $visit)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete_item">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
