<?php

use Inertia\Inertia;
use App\Models\Resident;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ResidentController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'residents' => Resident::all()->count(),
        'verified' => Resident::verified()->count(),
        'unverified' => Resident::unverified()->count()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('register', [ResidentController::class, 'create'])->name('register');
Route::post('register', [ResidentController::class, 'register']);

Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');
Route::post('/residents/store', [ResidentController::class, 'store'])->name('residents.store');
Route::put('/residents/{resident}/update', [ResidentController::class, 'update'])->name('residents.update');
Route::put('/residents/{resident}/verify', [ResidentController::class, 'verify'])->name('residents.verify');
Route::delete('/resident/{resident}/delete', [ResidentController::class, 'destroy'])->name('residents.destroy');
Route::get('resident/{resident}/pdf', [ResidentController::class, 'pdf'])->name('residents.pdf');