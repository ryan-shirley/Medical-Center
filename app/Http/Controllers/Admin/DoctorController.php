<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Doctor;
use App\Role;
use App\User;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Prevent unauthorised users from accessing these pages.
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();

        return view('admin.doctors.index')->with([
            'doctors' => $doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate doctor data against rules.
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|integer|digits_between:1,11',
            'started_working' => 'required|date'
        ]);

        // Create doctor
        // Stores data in both user and doctor table
        $user_doctor = new User();
        $user_doctor->name = $request->input('name');
        $user_doctor->email = $request->input('email');
        $user_doctor->password = bcrypt('secret');
        $user_doctor->save();

        $role_doctor = Role::where('name', 'doctor')->first();
        $user_doctor->roles()->attach($role_doctor);

        $doctor = new Doctor();
        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->started_working = $request->input('started_working');
        $doctor->user_id = $user_doctor->id;
        $doctor->save();

        // Send user back to main doctor view with success message
        $request->session()->flash('alert-success', 'Doctor successfully created');
        return redirect()->route('admin.doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('admin.doctors.show')->with([
            'doctor' => $doctor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('admin.doctors.edit')->with([
            'doctor' => $doctor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,id,' . $doctor->user->id,
            'address' => 'required|string|max:255',
            'phone' => 'required|integer|digits_between:1,11',
            'started_working' => 'required|date'
        ]);

        // Update doctor details
        $user_doctor = $doctor->user;
        $user_doctor->name = $request->input('name');
        $user_doctor->email = $request->input('email');
        $user_doctor->save();

        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->started_working = $request->input('started_working');
        $doctor->save();

        // Send user back to main doctor view with success message
        $request->session()->flash('alert-success', 'Doctor successfully updated');
        return redirect()->route('admin.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor_user = User::findOrFail($doctor->user->id);

        // If doctor still has visits prevent delete and show warning message. Otherwise delete and show success message.
        if($doctor->visits()->count() == 0) {
            $doctor_user->delete();
            $request->session()->flash('alert-success', 'Doctor successfully deleted');
            return redirect()->route('admin.doctors.index');
        }
        else {
            $request->session()->flash('alert-warning', 'Doctor has visits. These need to be deleted before the doctor can be deleted.');
            return redirect()->route('admin.doctors.index');
        }
    }
}
