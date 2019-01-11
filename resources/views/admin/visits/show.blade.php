@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="display-4">Visit</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-hover table-striped table-bordered">
        <tbody>
            <tr>
                <td>Date</td>
                <td>{{ date("d M Y", strtotime($visit->date)) }}</td>
            </tr>
            <tr>
                <td>Time</td>
                <td>{{ $visit->time }}</td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>{{ $visit->duration }}</td>
            </tr>
            <tr>
                <td>Cost</td>
                <td>{{ $visit->cost }}</td>
            </tr>
        </tbody>
    </table>

    <div class="row mt-5 mb-3">
        <div class="col-6">
            <h3>Patient</h3>

            <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <td>Name</td>
                        <td>{{ $visit->patient->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $visit->patient->address }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $visit->patient->phone }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $visit->patient->user->email }}</td>
                    </tr>
                    <tr>
                        <td>insurance</td>
                        <td>
                            @if ($visit->patient->insurance == true)
                                Yes
                                @else
                                No
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>insurance_company</td>
                        <td>{{ $visit->patient->insurance_company }}</td>
                    </tr>
                    <tr>
                        <td>insurance_policy_no</td>
                        <td>{{ $visit->patient->insurance_policy_no }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h3>Doctor</h3>

            <table class="table table-hover table-striped table-bordered">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ $visit->doctor->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $visit->doctor->address }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $visit->doctor->phone }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $visit->doctor->user->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
