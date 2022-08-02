<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Inertia\Inertia;
use Illuminate\Http\Request;

class Devices extends Controller
{
    public function index(){
        $devices = Device::all();

        return Inertia::render('Devices/Index', [
            'devices' => $devices,
        ]);
    }

    public function create(){
        return Inertia::render('Devices/Create');
    }

    public function edit(Request $request, $id){
        $device = Device::find($id);

        return Inertia::render('Devices/Edit', [
            'device' => $device,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'mac_address' => 'required|unique:devices',
        ]);

        $device = Device::create($request->all());

        return redirect()->route('devices');
    }

    public function update(Request $request, $id){
        $request->validate([
            'mac_address' => 'required|unique:devices,mac_address,'.$id,
        ]);

        $device = Device::find($id);
        $device->update($request->all());

        return redirect()->route('devices');
    }

    public function destroy($id){
        $device = Device::find($id);
        $device->delete();

        return redirect()->route('devices');
    }

}
