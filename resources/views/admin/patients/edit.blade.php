@extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <h1 class="display-4">Edit Patient</h1>
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
                    <form method="POST" action="{{ route('admin.patients.update', $patient )}}">
                        @csrf
                        @method('PUT')
                        <table class="mb-3">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" class="form-control"  name="name" value="{{ old('name', $patient->user->name) }}"/></td>
                                    <td>{{ ($errors->has('name')) ? $errors->first('name') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" class="form-control" name="email"  value="{{ old('email', $patient->user->email) }}" /></td>
                                    <td>{{ ($errors->has('email')) ? $errors->first('email') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><textarea type="text" class="form-control" name="address">{{ old('address', $patient->address) }}</textarea></td>
                                    <td>{{ ($errors->has('address')) ? $errors->first('address') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" class="form-control" name="phone"  value="{{ old('phone', $patient->phone) }}"/></td>
                                    <td>{{ ($errors->has('phone')) ? $errors->first('phone') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Insurance</td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="insurance"  value="1" @if(old('insurance', $patient->insurance) == true) checked @endif>
                                            <label class="form-check-label" for="insurance">
                                            Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="insurance"  value="0" @if(old('insurance', $patient->insurance) == false) checked @endif>
                                            <label class="form-check-label" for="insurance">
                                            No
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $errors->first('phone') }}</td>
                                </tr>
                                <tr>
                                    <td>Insurance Company</td>
                                    <td><input type="text" class="form-control" name="insurance_company"  value="{{ old('insurance_company', $patient->insurance_company) }}"/></td>
                                    <td>{{ ($errors->has('insurance_company')) ? $errors->first('insurance_company') : "" }}</td>
                                </tr>
                                <tr>
                                    <td>Insurance Policy Number</td>
                                    <td><input type="text" class="form-control" name="insurance_policy_no"  value="{{ old('insurance_policy_no', $patient->insurance_policy_no) }}"/></td>
                                    <td>{{ ($errors->has('insurance_policy_no')) ? $errors->first('insurance_policy_no') : "" }}</td>
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
