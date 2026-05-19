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
    
    if (auth()->check()) {
        $candidate->update(['is_checked_in' => true]);
        \Filament\Notifications\Notification::make()
            ->title('تم تسجيل الحضور بنجاح')
            ->success()
            ->send();
        return redirect(\App\Filament\Resources\CandidateResource::getUrl('view', ['record' => $candidate]));
    }
    
    return view('candidate-public', compact('candidate'));
})->name('candidates.checkin');

Route::get('/candidates/poster', function (\Illuminate\Http\Request $request) {
    $ids = explode(',', $request->query('ids', ''));
    $candidates = \App\Models\Candidate::whereIn('id', $ids)->get();
    return view('candidates-poster', compact('candidates'));
})->name('candidates.poster');

// Candidate Portal Routes
Route::prefix('portal')->name('portal.')->group(function () {
    // Setup (Signed URL)
    Route::get('/setup/{id}', [\App\Http\Controllers\CandidatePortalController::class, 'setupForm'])->name('setup')->middleware('signed');
    Route::post('/setup/{id}', [\App\Http\Controllers\CandidatePortalController::class, 'setupSave'])->name('setup.save')->middleware('signed');

    // Login
    Route::get('/login', [\App\Http\Controllers\CandidatePortalController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\CandidatePortalController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\CandidatePortalController::class, 'logout'])->name('logout');

    // Protected Routes
    Route::middleware('auth:candidate')->group(function () {
        Route::get('/', [\App\Http\Controllers\CandidatePortalController::class, 'dashboard'])->name('dashboard');
        Route::post('/submit-photos', [\App\Http\Controllers\CandidatePortalController::class, 'submitPhotos'])->name('submit_photos');
    });
});
