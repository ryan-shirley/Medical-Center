<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 roles
        $admin = new Role();
        $admin->name = 'admin';
        $admin->description = 'An Administrator';
        $admin->save();

        $doctor = new Role();
        $doctor->name = 'doctor';
        $doctor->description = 'A Doctor';
        $doctor->save();

        $patient = new Role();
        $patient->name = 'patient';
        $patient->description = 'A Patient';
        $patient->save();
    }
}
