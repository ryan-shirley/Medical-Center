<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Patient;
Use App\User;
use App\Role;
use Validator;

class PatientController extends Controller
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
        $patients = Patient::all();

        return view('admin.patients.index')->with([
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create custom error messages
        $messages = [
            'insurance_company.required_if' => 'The insurance company field is required!',
            'insurance_policy_no.required_if' => 'The insurance policy number field is required!',
        ];

        // Make validator with validation rules and custom error messages.
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|integer|digits_between:1,11',
            'insurance' => 'required|boolean',
            'insurance_company' => 'required_if:insurance, 1|max:255',
            'insurance_policy_no' => 'required_if:insurance, 1|max:255'
        ], $messages);

        // Error with form data. Redirect back to form page.
        if ($validator->fails()) {
            return redirect()->route('admin.patients.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Create Patient
        // Stores data in both user and patients table
        $user_patient = new User();
        $user_patient->name = $request->input('name');
        $user_patient->email = $request->input('email');
        $user_patient->password = bcrypt('secret');
        $user_patient->save();

        $role_patient = Role::where('name', 'patient')->first();
        $user_patient->roles()->attach($role_patient);

        $patient = new Patient();
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
        $patient->insurance = $request->input('insurance');

        // Validate insurance fields if user selected. Otherwise ensure details are empty.
        if($patient->insurance == true) {
            $request->validate([
                'insurance_company' => 'required|max:255',
                'insurance_policy_no' => 'required|max:255'
            ]);

            $patient->insurance_company = $request->input('insurance_company');
            $patient->insurance_policy_no = $request->input('insurance_policy_no');
        }
        else {
            $request->validate([
                'insurance_company' => 'nullable|size:0',
                'insurance_policy_no' => 'nullable|size:0'
            ]);

            $patient->insurance_company = null;
            $patient->insurance_policy_no = null;
        }

        $patient->user_id = $user_patient->id;
        $patient->save();

        // Send user back to main patient view with success message
        $request->session()->flash('alert-success', 'Patient successfully created');
        return redirect()->route('admin.patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return view('admin.patients.show')->with([
            'patient' => $patient
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
        $patient = Patient::findOrFail($id);

        return view('admin.patients.edit')->with([
            'patient' => $patient
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
        $patient = Patient::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,id,' . $patient->user->id,
            'address' => 'required|string|max:255',
            'phone' => 'required|integer|digits_between:1,11',
            'insurance' => 'required|boolean',
            'insurance_company' => 'required_if:insurance, 1|max:255',
            'insurance_policy_no' => 'required_if:insurance, 1|max:255'
        ]);

        // Update patient details
        $user_patient = $patient->user;
        $user_patient->name = $request->input('name');
        $user_patient->email = $request->input('email');
        $user_patient->save();

        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
        $patient->insurance = $request->input('insurance');

        // Validate insurance fields if user selected. Otherwise ensure details are empty.
        if($patient->insurance == true) {
            $request->validate([
                'insurance_company' => 'required|max:255',
                'insurance_policy_no' => 'required|max:255'
            ]);

            $patient->insurance_company = $request->input('insurance_company');
            $patient->insurance_policy_no = $request->input('insurance_policy_no');
        }
        else {
            $request->validate([
                'insurance_company' => 'nullable|size:0',
                'insurance_policy_no' => 'nullable|size:0'
            ]);

            $patient->insurance_company = null;
            $patient->insurance_policy_no = null;
        }

        $patient->save();

        // Send user back to main patient view with success message
        $request->session()->flash('alert-success', 'Patient successfully updated');
        return redirect()->route('admin.patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient_user = User::findOrFail($patient->user->id);

        // If patient still has visits prevent delete and show warning message. Otherwise delete and show success message.
        if($patient->visits()->count() == 0) {
            $patient_user->delete();
            $request->session()->flash('alert-success', 'Patient successfully deleted');
            return redirect()->route('admin.patients.index');
        }
        else {
            $request->session()->flash('alert-warning', 'Patient has visits. These need to be deleted before the patient can be deleted.');
            return redirect()->route('admin.patients.index');
        }
    }
}
