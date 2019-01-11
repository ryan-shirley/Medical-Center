@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Patient</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('doctor.home') }}" class="btn btn-primary">Back</a>

                    <table class="table">
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
                                <td>insurance_company</td>
                                <td>{{ $patient->insurance_company }}</td>
                            </tr>
                            <tr>
                                <td>insurance_policy_no</td>
                                <td>{{ $patient->insurance_policy_no }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Visits</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Cost</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
