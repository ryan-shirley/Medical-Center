@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Visits</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('admin.visits.create') }}" class="btn btn-primary float-right btn-lg">Add Visit</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Cost</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visits as $visit)
            <tr>
                <td>{{ date("d M Y", strtotime($visit->date)) }}</td>
                <td>{{ $visit->time }}</td>
                <td>{{ $visit->duration }}</td>
                <td>{{ $visit->cost }}</td>
                <td>{{ $visit->patient->user->name }}</td>
                <td>{{ $visit->doctor->user->name }}</td>
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
