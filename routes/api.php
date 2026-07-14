<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicDoctorController;
use App\Http\Controllers\PublicSpecialtyController;
use App\Http\Controllers\PublicAssessmentController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSpecialtyController;

use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Doctor\DoctorBookingController;
use App\Http\Controllers\Doctor\DoctorPatientController;

use App\Http\Controllers\Patient\PatientBookingController;
use App\Http\Controllers\Patient\PatientFileController;

use App\Http\Controllers\Shared\ChatController;
use App\Http\Controllers\Shared\NotificationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);

Route::get('/doctors', [PublicDoctorController::class, 'index']);
Route::get('/doctors/{id}', [PublicDoctorController::class, 'show']);
Route::get('/specialties', [PublicSpecialtyController::class, 'index']);
Route::post('/assessment/guest-evaluate', [PublicAssessmentController::class, 'guestEvaluate']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:patient')->group(function () {
        Route::get('/patient/bookings', [PatientBookingController::class, 'index']);
        Route::post('/patient/bookings', [PatientBookingController::class, 'store']);
        Route::put('/patient/bookings/{id}', [PatientBookingController::class, 'update']);
        Route::delete('/patient/bookings/{id}', [PatientBookingController::class, 'destroy']);

        Route::get('/patient/medical-file', [PatientFileController::class, 'showMedicalFile']);
        Route::post('/patient/bookings/{id}/rate', [PatientBookingController::class, 'rateDoctor']);
        Route::post('/patient/assessment/save', [PublicAssessmentController::class, 'saveResult']);
    });

    Route::middleware('role:doctor')->group(function () {
        Route::post('/doctor/apply', [DoctorProfileController::class, 'submitApplication']);
        Route::put('/doctor/profile', [DoctorProfileController::class, 'updateProfile']);
        
        Route::get('/doctor/bookings', [DoctorBookingController::class, 'index']);
        Route::put('/doctor/bookings/{id}/status', [DoctorBookingController::class, 'changeStatus']);
        
        Route::get('/doctor/patients', [DoctorPatientController::class, 'index']);
        Route::get('/doctor/patients/{id}/history', [DoctorPatientController::class, 'patientHistory']);
        Route::post('/doctor/patients/{id}/notes', [DoctorPatientController::class, 'addSessionNotes']);
        Route::post('/doctor/patients/{id}/treatment-plan', [DoctorPatientController::class, 'updatePlan']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/doctor-applications', [AdminController::class, 'getPendingDoctors']);
        Route::put('/admin/doctor-applications/{id}/approve', [AdminController::class, 'approveDoctor']);
        Route::put('/admin/doctor-applications/{id}/reject', [AdminController::class, 'rejectDoctor']);

        Route::get('/admin/users', [AdminController::class, 'getAllUsers']);
        Route::delete('/admin/users/{id}', [AdminController::class, 'banUser']);
        Route::apiResource('/admin/specialties', AdminSpecialtyController::class);
        Route::get('/admin/reports', [AdminController::class, 'getComplaints']);
        Route::get('/admin/stats', [AdminController::class, 'getSystemStats']);
    });

    Route::get('/sessions/{id}/messages', [ChatController::class, 'fetchMessages']);
    Route::post('/sessions/{id}/messages', [ChatController::class, 'sendMessage']);
    Route::get('/notifications', [NotificationController::class, 'getUserNotifications']);
});