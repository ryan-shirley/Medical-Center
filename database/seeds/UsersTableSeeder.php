<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Doctor;
use App\Patient;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 users
        $role_admin = Role::where('name', 'admin')->first();
        $role_doctor = Role::where('name', 'doctor')->first();
        $role_patient = Role::where('name', 'patient')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $user_doctor = new User();
        $user_doctor->name = 'doctor';
        $user_doctor->email = 'doctor@example.com';
        $user_doctor->password = bcrypt('secret');
        $user_doctor->save();
        $user_doctor->roles()->attach($role_doctor);
        $doctor = new Doctor();
        $doctor->address = 'IADT Road';
        $doctor->phone = '0871234567';
        $doctor->started_working = '2018/12/15';
        $doctor->user_id = $user_doctor->id;
        $doctor->save();

        $user_patient = new User();
        $user_patient->name = 'patient';
        $user_patient->email = 'patient@example.com';
        $user_patient->password = bcrypt('secret');
        $user_patient->save();
        $user_patient->roles()->attach($role_patient);
        $patient = new Patient();
        $patient->address = 'IADT Road';
        $patient->phone = '0871234567';
        $patient->insurance = true;
        $patient->insurance_company = 'VHI';
        $patient->insurance_policy_no = 'VHI-1234567890';
        $patient->user_id = $user_patient->id;
        $patient->save();
    }
}
