<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');
Route::get('/doctor/home', 'Doctor\HomeController@index')->name('doctor.home');
Route::get('/doctor/patient/{id}', 'Doctor\PatientController@index')->name('doctor.patient.view');
Route::get('/patient/home', 'Patient\HomeController@index')->name('patient.home');
Route::get('/patient/doctor/{id}', 'Patient\DoctorController@index')->name('patient.doctor.view');

Route::resource('admin/doctors', 'Admin\DoctorController', array('as'=>'admin'));
Route::resource('admin/patients', 'Admin\PatientController', array('as'=>'admin'));
Route::resource('admin/visits', 'Admin\VisitController', array('as'=>'admin'));
