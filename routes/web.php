<?php

use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\TwofaVerificationController;
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

Route::group(
    [
        'middleware' => 'guest',
    ],
    function () {
        Route::get('/register', [RegistrationController::class, 'create'])->name('registration.form');
        Route::post('/register', [RegistrationController::class, 'store'])->name('register');
        Route::get('check-email', [RegistrationController::class, 'checkIfEmailExists']);

        Route::get('/login', [SessionController::class, 'showLoginPage'])->name('login.form');
        Route::post('/login', [SessionController::class, 'login'])->name('login');
    }
);


Route::group(
    [
        'middleware' => ['auth'],
    ],
    function () {

        Route::post('/logout-and-register', [SessionController::class, 'logoutAndRedirectToRegister'])
            ->name('logout_and_register');

        Route::group(
            [
                'middleware' => 'twoFactor',
            ],
            function () {

                Route::post('/logout', [SessionController::class, 'logoutAndRedirectToHome'])
                    ->name('logout');

                ///2fa
                Route::get('/verify', [TwofaVerificationController::class, 'index'])->name('verify.index');
                Route::post('/verify', [TwofaVerificationController::class, 'verify'])->name('verify.login');
                Route::get('/verify/resend', [TwofaVerificationController::class, 'resend'])->name('verify.resend');

                Route::get('/', function () {
                    return view('welcome');
                });
            }
        );
    }

);
