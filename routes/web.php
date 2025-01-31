<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretariesController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });


    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //Rutas de Usuarios
    Route::middleware(['auth','role:Administrador'])->group(function () {
        Route::resource('users', UsersController::class);
        Route::resource('patients', PatientsController::class);
    });

    Route::middleware(['auth','role:Secretaria,Administrador'])->group(function () {
        Route::resource('users', UsersController::class)->only([
            'index', 'show','edit'
        ]);
        Route::resource('patients', PatientsController::class)->only([
            'index', 'show','edit'
        ]);
    });

    //Rutas de Medico
    Route::middleware('auth')->group(function () {
        Route::get('/doctors/index', [DoctorsController::class, 'index'])->name('doctors.index');
        Route::get('/doctors/create', [DoctorsController::class, 'create'])->name('doctors.create');
        Route::post('/doctors', [DoctorsController::class, 'store'])->name('doctors.store');
        Route::get('/doctors/{doctor}/show', [DoctorsController::class, 'show'])->name('doctors.show');
        Route::get('/doctors/{doctor}', [DoctorsController::class, 'edit'])->name('doctors.edit');
        Route::patch('/doctors/{doctor}/updated', [DoctorsController::class, 'update'])->name('doctors.update');
        Route::delete('/doctors/{patient}', [DoctorsController::class, 'destroy'])->name('doctors.destroy');
    });

    //Rutas de Secretaria
    Route::middleware('auth')->group(function () {
        Route::get('/secretaries/index', [SecretariesController::class, 'index'])->name('secretaries.index');
        Route::get('/secretaries/create', [SecretariesController::class, 'create'])->name('secretaries.create');
        Route::post('/secretaries', [SecretariesController::class, 'store'])->name('secretaries.store');
        Route::get('/secretaries/{secretary}/show', [SecretariesController::class, 'show'])->name('secretaries.show');
        Route::get('/secretaries/{secretary}', [SecretariesController::class, 'edit'])->name('secretaries.edit');
        Route::patch('/secretaries/{secretary}/updated', [SecretariesController::class, 'update'])->name('secretaries.update');
        Route::delete('/secretaries/{secretary}', [SecretariesController::class, 'destroy'])->name('secretaries.destroy');
    });

    //Rutas de Secretaria
    Route::middleware('auth')->group(function () {
        Route::get('/specialties/index', [SpecialtiesController::class, 'index'])->name('specialties.index');
        Route::get('/specialties/create', [SpecialtiesController::class, 'create'])->name('specialties.create');
        Route::post('/specialties', [SpecialtiesController::class, 'store'])->name('specialties.store');
        Route::get('/specialties/{specialty}/show', [SpecialtiesController::class, 'show'])->name('specialties.show');
        Route::get('/specialties/{specialty}', [SpecialtiesController::class, 'edit'])->name('specialties.edit');
        Route::patch('/specialties/{specialty}/updated', [SpecialtiesController::class, 'update'])->name('specialties.update');
        Route::delete('/specialties/{specialty}', [SpecialtiesController::class, 'destroy'])->name('specialties.destroy');
    });

    //Rutas de Citas
    Route::middleware('auth')->group(function () {
        Route::get('/appointments/index', [SpecialtiesController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/create', [SpecialtiesController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [SpecialtiesController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}/show', [SpecialtiesController::class, 'show'])->name('appointments.show');
        Route::get('/appointments/{appointment}', [SpecialtiesController::class, 'edit'])->name('appointments.edit');
        Route::patch('/appointments/{appointment}/updated', [SpecialtiesController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}', [SpecialtiesController::class, 'destroy'])->name('appointments.destroy');
    });

    //Rutas de Citas
    Route::middleware('auth')->group(function () {
        Route::get('/histories/index', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/create', [HistoriesController::class, 'create'])->name('histories.create');
        Route::post('/histories', [HistoriesController::class, 'store'])->name('histories.store');
        Route::get('/histories/{history}/show', [HistoriesController::class, 'show'])->name('histories.show');
        Route::get('/histories/{history}', [HistoriesController::class, 'edit'])->name('histories.edit');
        Route::patch('/histories/{history}/updated', [HistoriesController::class, 'update'])->name('histories.update');
        Route::delete('/histories/{history}', [HistoriesController::class, 'destroy'])->name('histories.destroy');
    });

    require __DIR__ . '/auth.php';
});
