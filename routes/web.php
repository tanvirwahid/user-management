<?php

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\TwoFaVerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
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
    return redirect(route('login'));
});

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
                Route::get('/verify', [TwoFaVerificationController::class, 'index'])->name('verify.index');
                Route::post('/verify', [TwoFaVerificationController::class, 'verify'])->name('verify.login');
                Route::get('/verify/resend', [TwoFaVerificationController::class, 'resend'])->name('verify.resend');

                Route::group([
                    'middleware' => [
                        'role:admin',
                    ],
                    'prefix' => '/admin',
                    'as' => 'admin.',
                ], function () {
                    Route::get('', [UserController::class, 'index'])->name('users');
                    Route::get('/download/{user}', [UserController::class, 'downloadIdVerificationDocument'])
                        ->name('download');
                });

                Route::group(
                    [
                        'prefix' => '/profile',
                        'as' => 'profile.',
                        'middleware' => [
                            'role:user',
                        ],
                    ],
                    function () {
                        Route::get('', [ProfileController::class, 'show'])->name('index');
                        Route::get('/download', [ProfileController::class, 'downloadNidDocument'])->name('download');
                    }
                );

                Route::group(
                    [
                        'prefix' => '/password-reset',
                        'as' => 'password-reset.',
                    ],
                    function () {
                        Route::get('', [PasswordResetController::class, 'index'])->name('index');
                        Route::post('', [PasswordResetController::class, 'update'])->name('update');
                    }
                );
            }
        );
    }

);
