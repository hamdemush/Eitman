<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\PsychologistProfileController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AssessmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Public Authentication, Password & General Routes
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('password')->group(function () {
    Route::post('/forgot', [PasswordResetController::class, 'sendResetLink']);
    Route::post('/reset', [PasswordResetController::class, 'reset']);
});
Route::get('/specializations', [SpecializationController::class, 'index']);
Route::get('/psychologists', [PsychologistProfileController::class, 'indexVerified']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Sanctum Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/profile', function (Request $request) {
        return response()->json($request->user());
    });

    Route::prefix('email')->group(function () {
        Route::post('/verify', [VerificationController::class, 'verify']);
        Route::post('/resend', [VerificationController::class, 'resend']);
    });

    /*
    |--------------------------------------------------------------------------
    | Role Based Routes Group
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        Route::post('/specializations', [SpecializationController::class, 'store']);
        Route::get('/specializations/{id}', [SpecializationController::class, 'show']);
        Route::put('/specializations/{id}', [SpecializationController::class, 'update']);
        Route::delete('/specializations/{id}', [SpecializationController::class, 'destroy']);
        Route::get('/admin/pending-psychologists', [AdminDashboardController::class, 'pendingPsychologists']);
        Route::post('/admin/verify-psychologist/{id}', [AdminDashboardController::class, 'verifyPsychologist']);
    });

    Route::middleware('psychologist')->group(function () {
        Route::post('/psychologist/profile', [PsychologistProfileController::class, 'storeOrUpdate']);
        Route::get('/psychologist/profile/me', [PsychologistProfileController::class, 'showCurrent']);
        Route::get('/psychologist/appointments', [AppointmentController::class, 'psychologistAppointments']);
        Route::put('/appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
    });

    Route::middleware('patient')->group(function () {
        Route::get('/patient/appointments', [AppointmentController::class, 'patientAppointments']);
        Route::post('/appointments/book', [AppointmentController::class, 'store']);
        Route::post('/assessments/submit', [AssessmentController::class, 'submitAssessment']);
        Route::get('/assessments/my-history', [AssessmentController::class, 'history']);
    });
});