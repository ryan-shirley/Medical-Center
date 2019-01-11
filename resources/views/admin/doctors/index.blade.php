@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Doctors</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary float-right btn-lg">Add Doctor</a>
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
                <th>Date Started Working</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->user->name }}</td>
                <td>{{ $doctor->address }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>{{ $doctor->user->email }}</td>
                <td>{{ date("d M Y", strtotime($doctor->started_working)) }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.doctors.destroy', $doctor)}}" method="POST">
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
