<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () { //guestはログインしていなければ本来の処理、していたらHOMEに飛ばす
    
    Route::get('register/precheck',[RegisteredUserController::class, 'precheck'])
                ->name('register.precheck');

    Route::post('register/precheck',[RegisteredUserController::class, 'precheck_store'])
                ->name('register.precheck.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');//ログイン画面表示

    Route::post('login', [AuthenticatedSessionController::class, 'store']);//ログイン

    Route::post('guestlogin', [RegisteredUserController::class, 'guestLogin'])
                ->name('guestlogin');//ゲストログイン

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

});



Route::middleware('auth')->group(function () {

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');
    
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])//確認メールのリンク踏んだときの処理
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

