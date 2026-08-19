<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\PsychologistProfileController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\SmartAssessmentController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\NotificationController;


/*
|--------------------------------------------------------------------------
| Public Routes (المسارات العامة)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/password/forgot', [PasswordResetController::class, 'sendResetLink']);
Route::post('/password/reset', [PasswordResetController::class, 'reset']);

Route::get('/specialties', [SpecialtyController::class, 'index']);
Route::get('/specialties/{id}', [SpecialtyController::class, 'show']);


/*
|--------------------------------------------------------------------------
| Protected Routes (المسارات المحمية - Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/email/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend']);

    Route::get('/sessions/{id}/messages', [ChatController::class, 'fetchMessages']);
    Route::post('/sessions/{id}/messages', [ChatController::class, 'sendMessage']);

    Route::get('/notifications', [NotificationController::class, 'getUserNotifications']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

    /*
    |--------------------------------------------------------------------------
    | Patient Routes (مسارات المريض)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:patient')->group(function () {
        Route::get('/patient/appointments', [AppointmentController::class, 'patientAppointments']);
        Route::post('/patient/appointments', [AppointmentController::class, 'store']);
        Route::put('/patient/appointments/{id}/status', [AppointmentController::class, 'updateStatus']);

        Route::post('/patient/assessment', [SmartAssessmentController::class, 'submitAssessment']);
        Route::get('/patient/assessment/history', [SmartAssessmentController::class, 'history']);
    });

    /*
    |--------------------------------------------------------------------------
    | Psychologist Routes (مسارات الطبيب)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:psychologist')->group(function () {
        Route::get('/psychologist/profile', [PsychologistProfileController::class, 'showCurrent']);
        Route::post('/psychologist/profile', [PsychologistProfileController::class, 'storeOrUpdate']);

        Route::get('/psychologist/appointments', [AppointmentController::class, 'psychologistAppointments']);
        Route::put('/psychologist/appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (مسارات مدير النظام)
    |--------------------------------------------------------------------------
    */
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/stats', [AdminController::class, 'systemStats']);
        Route::get('/admin/pending-psychologists', [AdminController::class, 'pendingPsychologists']);
        Route::put('/admin/psychologists/{id}/approve', [AdminController::class, 'approvePsychologist']);
        Route::delete('/admin/psychologists/{id}/reject', [AdminController::class, 'rejectPsychologist']);

        Route::get('/admin/users', [AdminController::class, 'indexUsers']);
        Route::put('/admin/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus']);

        Route::post('/admin/specialties', [SpecialtyController::class, 'store']);
        Route::put('/admin/specialties/{id}', [SpecialtyController::class, 'update']);
        Route::delete('/admin/specialties/{id}', [SpecialtyController::class, 'destroy']);
    });

});