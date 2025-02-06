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
use Laravel\Dusk\Http\Controllers\UserController;

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

        Route::resource('users', UsersController::class);
        Route::resource('patients', PatientsController::class);
        Route::resource('doctors', DoctorsController::class);
        Route::resource('secretaries', SecretariesController::class);
        Route::resource('specialties', SpecialtiesController::class);
        Route::resource('appointments', AppointmentsController::class);
        Route::resource('histories', HistoriesController::class);

        //Rutas adicionales
        Route::get('/users/{user}/promote', [UsersController::class, 'promote'])->name('users.promote');
        Route::post('/users/{user}/promote', [UsersController::class, 'promoteStore'])->name('users.promoteStore');
    });

    require __DIR__ . '/auth.php';
});
