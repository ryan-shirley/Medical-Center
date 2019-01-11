@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Doctor</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.doctors.store' )}}">
                        @csrf
                        <table>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" name="name" value="{{ old('name') }}"/></td>
                                    <td>{{ $errors->first('name') }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email"  value="{{ old('email') }}"/></td>
                                    <td>{{ $errors->first('email') }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><textarea type="text" name="address">{{ old('address') }}</textarea></td>
                                    <td>{{ $errors->first('address') }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" name="phone"  value="{{ old('phone') }}"/></td>
                                    <td>{{ $errors->first('phone') }}</td>
                                </tr>
                                <tr>
                                    <td>date started_working</td>
                                    <td><input type="date" name="started_working"  value="{{ old('started_working') }}"/></td>
                                    <td>{{ $errors->first('started_working') }}</td>
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
