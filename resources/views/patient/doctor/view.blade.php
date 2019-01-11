@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Doctor</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('patient.home') }}" class="btn btn-primary">Back</a>

                    <div class="card-body">
                        <table class="table">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
