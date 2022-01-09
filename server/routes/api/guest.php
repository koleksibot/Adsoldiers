<?php
/**
 * Apis for Guest users(to allow them to login, register, etc.)
 * PHP version 7.2
 */
Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::post('/register', \App\Users\Actions\RegisterUserAction::class);
        Route::post('/login', \App\Users\Actions\LoginUserAction::class)->name('login');
        Route::post('/forgot-password', \App\Users\Actions\ForgotUserPasswordAction::class);
        Route::get('/reset-password/{userEmail}/{token}', \App\Users\Actions\ValidateUserReminderTokenAction::class);
        Route::post('/reset-password/{userEmail}/{token}', \App\Users\Actions\ResetUserPasswordAction::class);
        Route::get('/activate/{userEmail}/{token}', \App\Users\Actions\ActivateUserAccountAction::class);
    }
);
