@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Patient: {{ $patient->user->name }}</h1>
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-hover table-striped table-bordered">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $patient->user->name }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $patient->address }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $patient->phone }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $patient->user->email }}</td>
            </tr>
            <tr>
                <td>insurance</td>
                <td>
                    @if ($patient->insurance == true)
                        Yes
                        @else
                        No
                    @endif
                </td>
            </tr>
            <tr>
                <td>insurance company</td>
                <td>{{ $patient->insurance_company }}</td>
            </tr>
            <tr>
                <td>insurance policy no</td>
                <td>{{ $patient->insurance_policy_no }}</td>
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
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Cost</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->visits as $visit)
            <tr>
                <td>{{ $visit->doctor->user->name }}</td>
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
