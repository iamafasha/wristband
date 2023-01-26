<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientContactPerson;
use App\Models\PatientDevice;
use App\Models\PatientDoctor;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class Patients extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $patients = Patient::with('user')->get();

        return Inertia::render('Patients/Index', [
            'patients' => $patients,
        ]);
    }

    public function create()
    {

        //get users who are not patients
        $users = User::ExcludeMe()->whereDoesntHave('patient')->get();

        return Inertia::render('Patients/Create',[
            'users' => $users,

        ]);
    }


    public function show(Patient $patient)
    {

        $patient = $patient->load(['user', 'devices', 'doctors.user', 'contactPersons']);
        $latest_reading = $patient->readings()->orderBy('created_at', 'desc')->first();
        return Inertia::render('Patients/Show', [
            'patient' => $patient,
            'latest_reading' => $latest_reading
        ]);
    }

    public function store(Request $request)
    {
        if($request->user_type == "existing"){
            $request->validate([
                'selected_user' => 'required|exists:users,id',
            ]);

            $user = User::find($request->selected_user);
            $user->patient()->create([
                'timestamps' => false,
            ]);
        }else{

            $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:255|unique:users',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $user->patient()->create([
                'timestamps' => false,
            ]);
        }

        return redirect()->route('patient.show', $user->patient->id);

    }

    public function edit(Patient $patient)
    {
        $patient = $patient->load(['user']);
        return Inertia::render('Patients/Edit', [
            'patient' => $patient
        ]);
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$patient->user->id,
            'phone' => 'required|string|max:255|unique:users,phone,'.$patient->user->id,
        ]);
        $patient->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);


        return redirect()->route('patient.show', $patient->id);
    }


    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients');
    }



    public function addDevice(Request $request, Patient $patient)
    {
        $patient->load('user');
        $devices = Device::whereDoesntHave('patientDevices')->get();
        return Inertia::render('Patients/AddDevice', [
            'patient' => $patient,
            'devices' => $devices,
        ]);
    }


    public function storeDevice(Request $request, Patient $patient)
    {
        //vaildate if device exists and has not relationship with any patient
        $request->validate([
            'device_id' => 'required|exists:devices,id',
        ]);

        $patient_device = PatientDevice::create([
            'patient_id' => $patient->id,
            'device_id' => $request->device_id,
        ]);

        return redirect()->route('patient.show', $patient->id);
    }

    public function detachDevice(Patient $patient, Device $device)
    {
        $patient->load('user');
        $device->load('patientDevices');
        $patient_device = $device->patientDevices->where('patient_id', $patient->id)->first();
        $patient_device->delete();
        return redirect()->route('patient.show', $patient->id);
    }


    public function addDoctor(Request $request, Patient $patient)
    {
        $patient->load('user');
        //Get doctors who are not assigned to patient where patient_id is $patient->id

        $doctors = Doctor::with('user')
            ->whereDoesntHave('patientDoctors', function($query) use ($patient){
                $query->where('patient_id', $patient->id);
            })->get();

        return Inertia::render('Patients/AddDoctor', [
            'patient' => $patient,
            'doctors' => $doctors,
        ]);
    }

    public function storeDoctor(Request $request, Patient $patient)
    {
        //vaildate if doctor exists and has not relationship with any patient
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $patient_doctor = PatientDoctor::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
        ]);

        return redirect()->route('patient.show', $patient->id);
    }

    public function detachDoctor(Patient $patient, Doctor $doctor)
    {
        $patient->load('user');
        $doctor->load('patientDoctors');
        $patient_doctor = $doctor->patientDoctors->where('patient_id', $patient->id)->first();
        $patient_doctor->delete();
        return redirect()->route('patient.show', $patient->id);
    }


    public function addContact(Request $request, Patient $patient)
    {
        $patient->load('user');


        //Users who are not a contactPatients of $patient
        $users = User::ExcludeMe()->whereDoesntHave('contactPatients', function($query) use ($patient){
            $query->where('patient_id', $patient->id);
        })->get();

        return Inertia::render('Patients/AddContact', [
            'patient' => $patient,
            'users' => $users,
        ]);
    }


    public function storeContact(Request $request, Patient $patient)
    {

        if($request->user_type == "existing"){
            $request->validate([
                'selected_user' => 'required|exists:users,id',
            ]);

            $user = User::find($request->selected_user);
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:255|unique:users',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }

        PatientContactPerson::create([
            'patient_id' => $patient->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('patient.show', $patient->id);
    }

    public function detachContact(Patient $patient, $user)
    {
        $user = User::find($user);
        $patient->patient_contact_people()->where('user_id', $user->id)->first()
            ->delete();
        return redirect()->route('patient.show', $patient->id);
    }

    public function dataAPI(Request $request, Patient $patient){
        // dd($patient);
        $start_time = strtotime($request->start_time ?? 'now - 6hours');
        $end_time = strtotime($request->end_time ?? 'now + 2min');

        $data = $patient->readings()->whereBetween(
            'patient_device_readings.created_at',
            [date('Y-m-d H:i:s', $start_time), date('Y-m-d H:i:s', $end_time)]
        )->orderBy('patient_device_readings.created_at', 'desc')
            ->get()->toArray();

        return response()->json([
            'min' => $start_time * 1000,
            'max' => $end_time * 1000,
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Summary of timeRange
     * @param mixed $start
     * @param mixed $end
     * @param mixed $step
     * @return array<array>
     */
    public static function timeRange($start, $end, $step = 1000)
    {
        $return = array();
        for( $time = $start; $time <= $end; $time += $step )
            $return[$time] = [
             'name' => date( 'Y-m-d g:ia', $time- $step )." - ".date( 'g:ia', $time ),
             'from' =>  $time - $step,
             'to' =>  $time,
            ];
        return $return;
    }

}
