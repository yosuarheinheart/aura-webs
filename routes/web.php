<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AncientAcademyController;
use App\Http\Controllers\ArtopiaController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminEmailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminArtopiaController;
use App\Http\Controllers\AdminAncientController;
use App\Http\Controllers\EmailTemplateController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('splash');
})->name('splash.view');

Route::get('/home', function () {
    return view('home');
})->name('home.view');

Route::get('/ancient', function () {
    return view('ancient');
})->name('ancient.view');

Route::get('/artopia', function () {
    return view('artopia');
})->name('artopia.view');

Route::get('/garden', function () {
    return view('garden');
})->name('garden.view');

Route::get('/event', function () {
    return view('event');
})->name('event.view');

Route::get('/galleryancient', function () {
    return view('galleryancient');
})->name('galleryancient.view');

Route::get('/division', function () {
    return view('division');
})->name('division.view');

Route::get('/ancientregistration', function () {
    return view('ancientregistration');
})->name('ancientregistration.view');

Route::get('/artopiaregistration', function () {
    return view('artopiaregistration');
})->name('artopiaregistration.view');

// Registration process routes
Route::get('/ancient-academy/register', [AncientAcademyController::class, 'showForm'])->name('ancient.register');
Route::post('/ancient-academy/register', [AncientAcademyController::class, 'store'])->name('ancient.store');

Route::get('/artopia/register', [ArtopiaController::class, 'showForm'])->name('artopia.register');
Route::post('/artopia/register', [ArtopiaController::class, 'store'])->name('artopia.store');

// Admin routes

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/artopia', [AdminController::class, 'artopia'])->name('artopia');
    Route::get('/ancient', [AdminController::class, 'ancient'])->name('ancient');
    
    // AJAX routes for admin - CORE FUNCTIONALITY
    Route::get('/get-participant', [AdminController::class, 'getParticipant'])->name('get.participant');
    
    // Artopia Management
    Route::prefix('artopia')->name('artopia.')->group(function () {
        Route::get('/', [AdminArtopiaController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminArtopiaController::class, 'show'])->name('show');
        Route::put('/{id}', [AdminArtopiaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminArtopiaController::class, 'destroy'])->name('destroy');
        Route::get('/export/data', [AdminArtopiaController::class, 'export'])->name('export');
        Route::post('/send-email', [AdminArtopiaController::class, 'sendBulkEmail'])->name('send-email');

    // ---Route untuk mengirim email status (tunggal dan massal) ---
        Route::post('/send-single-status-email/{id}', [AdminArtopiaController::class, 'sendSingleStatusEmail'])->name('send-single-status-email');
        Route::post('/send-bulk-status-email', [AdminArtopiaController::class, 'sendBulkStatusEmail'])->name('send-bulk-status-email');
    });
    
    // Ancient Management
    Route::prefix('ancient')->name('ancient.')->group(function () {
        Route::get('/', [AdminAncientController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminAncientController::class, 'show'])->name('show');
        Route::put('/{id}', [AdminAncientController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminAncientController::class, 'destroy'])->name('destroy');
        Route::get('/export/data', [AdminAncientController::class, 'export'])->name('export');
        Route::post('/send-email', [AdminAncientController::class, 'sendBulkEmail'])->name('send-email');

        // Email routes - support both GET and POST for flexibility
        Route::get('/send-single-email/{id}', [AdminAncientController::class, 'sendSingleEmail'])->name('send-single-email');
        Route::post('/send-single-email/{id}', [AdminAncientController::class, 'sendSingleEmail'])->name('send-single-email-post');
        Route::post('/send-bulk-status-email', [AdminAncientController::class, 'sendBulkStatusEmail'])->name('send-bulk-status-email');
    });
    
    // Email Templates
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/email', [EmailTemplateController::class, 'index'])->name('email-templates.index');
        Route::post('/email', [EmailTemplateController::class, 'store'])->name('email-templates.store');
        Route::put('/update/{id}', [EmailTemplateController::class, 'update'])->name('email-templates.update');
        Route::delete('/email/{id}', [EmailTemplateController::class, 'destroy'])->name('email-templates.destroy');
    });

    
    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
});