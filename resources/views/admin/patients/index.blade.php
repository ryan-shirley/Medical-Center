@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Patients</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('admin.patients.create') }}" class="btn btn-primary float-right btn-lg">Add Patient</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>insurance policy no</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
            <tr>
                <td>{{ $patient->user->name }}</td>
                <td>{{ $patient->address }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->user->email }}</td>
                <td>{{ $patient->insurance_policy_no }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.patients.destroy', $patient)}}" method="POST">
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
