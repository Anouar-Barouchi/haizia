<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/test-route', function () {
    return "Code is updated: " . now();
});

Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('/checkin/{code}', function ($code) {
    $candidate = \App\Models\Candidate::where('code', $code)->firstOrFail();
    return redirect(\App\Filament\Resources\CandidateResource::getUrl('view', ['record' => $candidate]));
})->name('candidates.checkin');
