@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Edit Doctor</h1>
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

                    <form method="POST" action="{{ route('admin.doctors.update', $doctor )}}">
                        @csrf
                        @method('PUT')
                        <table class="mb-3">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" class="form-control" name="name" value="{{ old('name', $doctor->user->name) }}"/></td>
                                    <td>{{ ($errors->has('name')) ? $errors->first('name') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" class="form-control" name="email"  value="{{ old('email', $doctor->user->email) }}"/></td>
                                    <td>{{ ($errors->has('email')) ? $errors->first('email') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><textarea type="text" class="form-control" name="address">{{ old('address', $doctor->address) }}</textarea></td>
                                    <td>{{ ($errors->has('address')) ? $errors->first('address') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" class="form-control" name="phone"  value="{{ old('phone', $doctor->phone) }}"/></td>
                                    <td>{{ ($errors->has('phone')) ? $errors->first('phone') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>date started working</td>
                                    <td><input type="date" class="form-control" name="started_working"  value="{{ old('started_working', $doctor->started_working) }}"/></td>
                                    <td>{{ ($errors->has('started_working')) ? $errors->first('started_working') : "" }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" value="Store" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
