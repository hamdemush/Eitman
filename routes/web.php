<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/emergency', function () {
    return view('pages.emergency');
})->name('emergency');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/articles', function () {
    return view('pages.articles');
})->name('articles.index');

Route::get('/articles/{id}', function () {
    return view('pages.article-details');
})->name('articles.show');

Route::get('/specialists', function () {
    return view('pages.specialists');
})->name('specialists.index');

Route::get('/specialists/{id}', function () {
    return view('pages.specialist-profile');
})->name('specialists.show');

Route::get('/assessment', function () {
    return view('pages.assessment');
})->name('assessment');

Route::get('/booking', function () {
    return view('pages.booking');
})->name('booking');


Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::get('/reset-password', function () {
        return view('auth.reset-password');
    })->name('password.reset');
});

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/therapists', function () {
        return view('admin.therapists');
    })->name('therapists');

    Route::get('/therapist-profile', function () {
        return view('admin.therapist-profile');
    })->name('therapist.profile');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    Route::get('/patient-profile', function () {
        return view('admin.patient-profile');
    })->name('patient.profile');

    Route::get('/specialties', function () {
        return view('admin.specialties');
    })->name('specialties');

    Route::get('/complaints', function () {
        return view('admin.complaints');
    })->name('complaints');

    Route::get('/complaint-details', function () {
        return view('admin.complaint-details');
    })->name('complaint.details');
});


Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('doctor.dashboard');
    })->name('dashboard');

    Route::get('/chat', function () {
        return view('doctor.chat');
    })->name('chat');

    Route::get('/patient-notes', function () {
        return view('doctor.patient-notes');
    })->name('patient-notes');

    Route::get('/profile', function () {
        return view('doctor.profile');
    })->name('profile');

    Route::get('/requests', function () {
        return view('doctor.requests');
    })->name('requests');

    Route::get('/schedule', function () {
        return view('doctor.schedule');
    })->name('schedule');
});


Route::prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', function () {
        return view('patient.dashboard');
    })->name('dashboard');

    Route::get('/chat', function () {
        return view('patient.chat');
    })->name('chat');

    Route::get('/progress', function () {
        return view('patient.progress');
    })->name('progress');

    Route::get('/sessions', function () {
        return view('patient.sessions');
    })->name('sessions');

    Route::get('/settings', function () {
        return view('patient.settings');
    })->name('settings');
});