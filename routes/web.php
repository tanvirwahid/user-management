<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

Route::get('/register', [RegistrationController::class, 'create'])->name('registration.form');
Route::post('/register', [RegistrationController::class, 'store'])->name('register');
Route::get('check-email', [RegistrationController::class, 'checkIfEmailExists']);
