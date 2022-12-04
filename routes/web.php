<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

require __DIR__.'/auth.php';


Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('doctors', App\Http\Controllers\Doctors::class , [
    'names' => [
        'index' => 'doctors',
        'create' => 'doctor.create',
        'store' => 'doctor.store',
        'edit' => 'doctor.edit',
        'update' => 'doctor.update',
        'destroy' => 'doctor.destroy',
    ]
] )->middleware(['auth', 'verified']);

Route::resource('devices', App\Http\Controllers\Devices::class , [
    'names' => [
        'index' => 'devices',
        'create' => 'device.create',
        'store' => 'device.store',
        'edit' => 'device.edit',
        'update' => 'device.update',
        'destroy' => 'device.destroy',
    ]
] )->middleware(['auth', 'verified']);

Route::get('patient/{patient}/device/add', 'App\Http\Controllers\Patients@addDevice' )
        ->name('patient.device.add');

Route::post('patient/{patient}/device/add', 'App\Http\Controllers\Patients@storeDevice' )
        ->name('patient.device.store');

Route::delete('patient/{patient}/device/{device}/detach', 'App\Http\Controllers\Patients@detachDevice' )
        ->name('patient.device.detach');

Route::get('patient/{patient}/doctor/add', 'App\Http\Controllers\Patients@addDoctor' )
        ->name('patient.doctor.add');

Route::post('patient/{patient}/doctor/add', 'App\Http\Controllers\Patients@storeDoctor' )
        ->name('patient.doctor.store');

Route::delete('patient/{patient}/doctor/{doctor}/detach', 'App\Http\Controllers\Patients@detachDoctor' )
        ->name('patient.doctor.detach');

Route::get('patient/{patient}/contact/add', 'App\Http\Controllers\Patients@addContact' )
        ->name('patient.contact.add');

Route::post('patient/{patient}/contact/add', 'App\Http\Controllers\Patients@storeContact' )
        ->name('patient.contact.store');
Route::delete('patient/{patient}/contact/{contact}/detach', 'App\Http\Controllers\Patients@detachContact' )
        ->name('patient.contact.detach');

Route::resource('patients', App\Http\Controllers\Patients::class , [
    'names' => [
        'index' => 'patients',
        'show' => 'patient.show',
        'create' => 'patient.create',
        'store' => 'patient.store',
        'edit' => 'patient.edit',
        'update' => 'patient.update',
        'destroy' => 'patient.destroy',
    ]
] )->middleware(['auth', 'verified']);

Route::get('api/patient/{patient}/data', 'App\Http\Controllers\Patients@dataAPI')->name('patient.data.api');
