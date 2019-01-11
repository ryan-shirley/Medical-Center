@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Edit Visit</h1>
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.visits.update', $visit )}}">
                        @csrf
                        @method('PUT')
                        <table class="mb-3">
                            <tbody>
                                <tr>
                                    <td>Date</td>
                                    <td><input type="date" class="form-control" name="date" value="{{ old('date', $visit->date) }}"/></td>
                                    <td>{{ ($errors->has('date')) ? $errors->first('date') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td><input type="time" class="form-control" name="time"  value="{{ old('time', date("H:i", strtotime($visit->time))) }}"/></td>
                                    <td>{{ ($errors->has('time')) ? $errors->first('time') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Duration (minutes)</td>
                                    <td><input type="text" class="form-control" name="duration"  value="{{ old('duration', $visit->duration) }}"/></td>
                                    <td>{{ ($errors->has('duration')) ? $errors->first('duration') : "" }}</td>
                                </tr>

                                <tr>
                                    <td>Cost</td>
                                    <td><input type="text" class="form-control" name="cost"  value="{{ old('cost', $visit->cost) }}"/></td>
                                    <td>{{ $errors->first('cost') }}</td>
                                </tr>
                                <tr>
                                    <td>Patient</td>
                                    <td>
                                        @foreach ($patients as $patient)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="patient_id"  value="{{ $patient->id }}" @if(old('patient_id', $visit->patient_id) == $patient->id) checked @endif>
                                            <label class="form-check-label" for="patient_id">
                                            {{ $patient->user->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>{{ ($errors->has('patient_id')) ? $errors->first('patient_id') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Doctor</td>
                                    <td>
                                        @foreach ($doctors as $doctor)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doctor_id"  value="{{ $doctor->id }}" @if(old('doctor_id', $visit->doctor_id) == $doctor->id) checked @endif>
                                            <label class="form-check-label" for="doctor_id">
                                            {{ $doctor->user->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>{{ ($errors->has('doctor_id')) ? $errors->first('doctor_id') : "" }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" value="Store" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
