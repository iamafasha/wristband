<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class Doctors extends Controller
{
    public function index(){
        $doctors = Doctor::with('user')->get();

        return Inertia::render('Doctors/Index', [
            'doctors' => $doctors,
        ]);
    }

    public function create(){
        return Inertia::render('Doctors/Create');
    }

    public function edit($id){
        $doctor = Doctor::with(['user'])->find($id);
        return Inertia::render('Doctors/Edit', [
            'doctor' => $doctor,
        ]);
    }

    public function store(Request $request){

        //TODO: check if user already exists and only add as a doctor

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'role' => 'required|string|max:255',
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        //save doctor without updated_at and created_at
        $user->doctor()->create([
            'role' => $request->role,
            'timestamps' => false,
        ]);


        return redirect()->route('doctors');
    }

    public function update(Request $request, $id){
        $doctor = Doctor::find($id);
        $user = $doctor->user;

       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:255|unique:users,phone,'.$user->id,
            'role' => 'required|string|max:255',
       ]);



        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->password && $request->password != ''){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $doctor->role = $request->role;
        $doctor->save();

        return redirect()->route('doctors');

    }


    public function destroy(Request $request, $id){
        $doctor = Doctor::find($id);
        $user = $doctor->user;
        $doctor->delete();
        $user->delete();
        return redirect()->route('doctors');
    }

}
