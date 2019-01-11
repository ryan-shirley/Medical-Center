@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Visit</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.visits.store' )}}">
                        @csrf
                        <table>
                            <tbody>
                                <tr>
                                    <td>Date</td>
                                    <td><input type="date" name="date" value="{{ old('date') }}"/></td>
                                    <td>{{ $errors->first('date') }}</td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td><input type="time" name="time"  value="{{ old('time') }}"/></td>
                                    <td>{{ $errors->first('time') }}</td>
                                </tr>
                                <tr>
                                    <td>Duration (minutes)</td>
                                    <td><input type="text" name="duration"  value="{{ old('duration') }}"/></td>
                                    <td>{{ $errors->first('duration') }}</td>
                                </tr>

                                <tr>
                                    <td>Cost</td>
                                    <td><input type="text" name="cost"  value="{{ old('cost') }}"/></td>
                                    <td>{{ $errors->first('cost') }}</td>
                                </tr>
                                <tr>
                                    <td>Patient</td>
                                    <td>
                                        @foreach ($patients as $patient)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="patient_id"  value="{{ $patient->id }}" @if(old('patient_id') == true) checked @endif>
                                            <label class="form-check-label" for="patient_id">
                                            {{ $patient->user->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $errors->first('patient_id') }}</td>
                                </tr>
                                <tr>
                                    <td>Doctor</td>
                                    <td>
                                        @foreach ($doctors as $doctor)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doctor_id"  value="{{ $doctor->id }}" @if(old('doctor_id') == true) checked @endif>
                                            <label class="form-check-label" for="doctor_id">
                                            {{ $doctor->user->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $errors->first('doctor_id') }}</td>
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
