<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Doctor;
use App\Patient;
use App\Visit;

class VisitController extends Controller
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
        $visits = Visit::all();

        return view('admin.visits.index')->with([
            'visits' => $visits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.visits.create')->with([
            'patients' => $patients,
            'doctors' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate visit data against rules.
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer',
            'cost' => 'required|numeric',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id'
        ]);

        // Create visit
        $visit = new Visit();
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->patient_id = $request->input('patient_id');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->save();

        // Send user back to main visit view with success message
        $request->session()->flash('alert-success', 'Visit successfully created');
        return redirect()->route('admin.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit = Visit::findOrFail($id);

        return view('admin.visits.show')->with([
            'visit' => $visit
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
        $visit = Visit::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.visits.edit')->with([
            'visit' => $visit,
            'patients' => $patients,
            'doctors' => $doctors
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
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer',
            'cost' => 'required|numeric',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id'
        ]);

        // Update visit details
        $visit = Visit::findOrFail($id);
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->patient_id = $request->input('patient_id');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->save();

        // Send user back to main visit view with success message
        $request->session()->flash('alert-success', 'Visit successfully updated');
        return redirect()->route('admin.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();

        // Send user back to main visit view with success message
        $request->session()->flash('alert-success', 'Visit successfully deleted');
        return redirect()->route('admin.visits.index');
    }
}
