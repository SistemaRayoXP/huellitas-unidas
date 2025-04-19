<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    Auth\LoginController,
    Auth\RegisterController,
    AnimalController,
    AdoptionController,
    ConversationController,
    MessageController,
    DonationController,
    SponsorController,
    RatingController,
    ReportController,
    ProfileController,
    AttachmentController,
};

/*
|--------------------------------------------------------------------------
| Web Routes – Huellitas Unidas
|--------------------------------------------------------------------------
| Rutas principales para la capa web (vistas Blade).  
| Cada ruta está pensada para mapearse a las historias de interacción y a las
| entidades definidas en el modelo de dominio del proyecto.
|
| Convenciones:  
| - Prefijos en inglés (REST‑like) para consistencia.  
| - "guest" para flujos públicos, "auth" para usuarios autenticados.  
| - Nombres de ruta en kebab‑case.  
|
| Nota: Las rutas de API (JSON) y web sockets se declaran en archivos separados
| (routes/api.php, routes/channels.php)
*/

/* ===================== PUBLIC/GUEST ===================== */

Route::get('/', HomeController::class)
    ->name('home');

// Autenticación (Laravel Breeze / Fortify)
Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'register'])->middleware('guest');

/* ---------- Catálogo de animales (público) ---------- */
Route::get('animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');

/* ===================== AUTHENTICATED USERS ===================== */
Route::middleware(['auth', 'verified'])->group(function () {
    /* ---------- Perfil y configuración ---------- */
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    /* ---------- CRUD completo de Animales ---------- */
    Route::resource('my-animals', AnimalController::class)->parameters([
        'my-animals' => 'animal',
    ])->except(['index', 'show'])->names('animals');

    /* ---------- Proceso de Adopción ---------- */
    Route::resource('adoptions', AdoptionController::class)->only(['index', 'store', 'update', 'destroy', 'show']);
    Route::post('adoptions/{adoption}/evaluate', [AdoptionController::class, 'evaluate'])->name('adoptions.evaluate');

    /* ---------- Chat & Q&A ---------- */
    Route::resource('conversations', ConversationController::class)->only(['index', 'show', 'store']);
    Route::post('conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');

    /* ---------- Calificaciones y reputación ---------- */
    Route::post('adoptions/{adoption}/ratings', [RatingController::class, 'store'])->name('ratings.store');

    /* ---------- Donaciones y Patrocinios ---------- */
    Route::get('donate', [DonationController::class, 'create'])->name('donations.create');
    Route::post('donate', [DonationController::class, 'store'])->name('donations.store');
    Route::resource('sponsors', SponsorController::class)->only(['index', 'create', 'store']);

    /* ---------- Denuncias ---------- */
    Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('reports', [ReportController::class, 'store'])->name('reports.store');

    /* ---------- Adjuntos genéricos ---------- */
    Route::post('attachments', [AttachmentController::class, 'store'])->name('attachments.store');
});

/* ===================== ADMIN / MODERATOR ===================== */
Route::middleware(['auth', 'role:admin|moderator'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard principal
    Route::view('/', 'admin.dashboard')->name('dashboard');

    // Gestión de usuarios, denuncias, animales, etc.
    Route::resource('animals', AnimalController::class)->only(['index', 'destroy', 'update']);
    Route::resource('users', ProfileController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('reports', ReportController::class)->only(['index', 'update']);
    Route::resource('donations', DonationController::class)->only(['index', 'show']);
});

/* ===================== FALLBACK ===================== */
Route::fallback(fn () => view('errors.404'))->name('fallback');
