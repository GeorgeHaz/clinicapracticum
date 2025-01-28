<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretariesController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\UserController;
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

    Route::resource('patients', PatientsController::class);

    Route::resource('specialties', SpecialtiesController::class);

    Route::resource('appointments', AppointmentsController::class);

    Route::resource('histories', HistoriesController::class);

    Route::resource('doctors', DoctorsController::class);

    Route::resource('secretaries', SecretariesController::class);


    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Mostrar usuarios
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Formulario de creación
        Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Guardar nuevo usuario
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');

    });

    require __DIR__.'/auth.php';
});
