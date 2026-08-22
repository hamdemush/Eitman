<?php

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

Route::get('/specialists', function () {
    return view('pages.specialists');
});

Route::get('/specialist-profile', function () {
    return view('pages.specialist-profile');
});

Route::get('/articles', function () {
    return view('pages.articles');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/emergency', function () {
    return view('pages.emergency');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/assessment', function () {
    return view('pages.assessment');
});

Route::get('/privacy', function () {
    return view('pages.privacy');
});

Route::get('/terms', function () {
    return view('pages.terms');
});

Route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard');
});