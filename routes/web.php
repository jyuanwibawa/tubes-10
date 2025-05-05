<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\WasteReportController;
use App\Http\Controllers\HomeController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPickupRequestController;
use App\Http\Controllers\DashboardController;
use App\Models\CollectionPoint;


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



Route::get('/collection-points', [MapController::class, 'index'])->name('collection-points.index');
Route::get('/collection-points/create', [MapController::class, 'create'])->name('collection-points.create');
Route::post('/collection-points', [MapController::class, 'store'])->name('collection-points.store');
Route::get('/collection-points/{id}/edit', [MapController::class, 'edit'])->name('collection-points.edit');
Route::put('/collection-points/{id}', [MapController::class, 'update'])->name('collection-points.update');
Route::delete('/collection-points/{id}', [MapController::class, 'destroy'])->name('collection-points.destroy');

// Redirect ke /home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticleController::class, 'listArticles']);
Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('article.show');
Route::get('/map', [MapController::class, 'index'])->name('map');

Route::get('/facilities', [MapController::class, 'index'])->name('peta.index');



// 🔐 Hanya untuk user yang sudah login
Route::middleware('checkRole:admin')->group(function () {
    Route::get('/admin/home', [ArticleController::class, 'index'])->name('admin.home');
    Route::get('/admin/sampah', [PickupRequestController::class, 'sampah'])->name('admin.sampah');

    Route::post('/articles', [ArticleController::class, 'store']);

    Route::put('/articles/{id}', [ArticleController::class, 'update']);

    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    Route::get('/admin/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

    // Admin Pickup Requests Routes
    Route::get('/admin/pickup-requests', [AdminPickupRequestController::class, 'index'])->name('admin.pickup-requests');
    Route::get('/admin/pickup-requests/{pickupRequest}', [AdminPickupRequestController::class, 'show'])->name('admin.pickup-requests.show');
    Route::put('/admin/pickup-requests/{pickupRequest}', [AdminPickupRequestController::class, 'update'])->name('admin.pickup-requests.update');
});

Route::match(['get', 'post'], '/admin/logout', [AdminController::class, 'logout'])->name('auth.admin.logout');
Route::match(['get', 'post'], '/user/logout', [LoginController::class, 'logout'])->name('auth.user.logout');
Route::match(['get', 'post'], '/pengelola/logout', [LoginController::class, 'logout'])->name('auth.pengelola.logout');

// 👤 Hanya untuk tamu (belum login)
Route::middleware('checkRole:guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('auth.admin.login');
    Route::post('/admin/login', [AdminController::class, 'login']);

    Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('auth.admin.register');
    Route::post('/admin/register', [AdminController::class, 'register']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Pickup Request Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('pickup')->group(function () {
        Route::get('/', [PickupRequestController::class, 'index'])->name('pickup.index');
        Route::get('/request', [PickupRequestController::class, 'requestPage'])->name('pickup.request-page');
        Route::get('/create', [PickupRequestController::class, 'create'])->name('pickup.create');
        Route::post('/', [PickupRequestController::class, 'store'])->name('pickup.store');
        Route::get('/history', [PickupRequestController::class, 'history'])->name('pickup.history');
        Route::get('/{pickupRequest}', [PickupRequestController::class, 'show'])->name('pickup.show');
    });
});

// Laporan Sampah
Route::middleware('checkRole:pengelola')->group(function () {
    Route::get('/laporan', [WasteReportController::class, 'laporan'])->name('laporan');
});



// Waste Reports Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('waste-reports')->group(function () {
        Route::get('/', [WasteReportController::class, 'index'])->name('waste-reports.index');
        Route::get('/create', [WasteReportController::class, 'create'])->name('waste-reports.create');
        Route::post('/', [WasteReportController::class, 'store'])->name('waste-reports.store');
        Route::get('/{wasteReport}', [WasteReportController::class, 'show'])->name('waste-reports.show');
        Route::get('/{wasteReport}/edit', [WasteReportController::class, 'edit'])->name('waste-reports.edit');
        Route::put('/{wasteReport}', [WasteReportController::class, 'update'])->name('waste-reports.update');
        Route::delete('/{wasteReport}', [WasteReportController::class, 'destroy'])->name('waste-reports.destroy');
    });
});
