<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController;
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

// web.php


 //Exportation & importation
 Route::get('contacts/export', [ContactController::class, 'export'])->name('contacts.export');
 Route::get('contacts/import', [ContactController::class, 'showImportForm'])->name('contacts.importForm');
 Route::post('contacts/import', [ContactController::class, 'import'])->name('contacts.import');

 // Route pour la gestion des fichiers
 Route::get('/files', [FileController::class, 'index'])->name('files.index');

 // Route pour télécharger le rapport PDF
 Route::get('/reports/download-pdf', [ReportController::class, 'generatePdfReport'])->name('reports.downloadPdf');

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

// Routes protégées par middleware auth et verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes pour le profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Routes pour les favoris
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/contacts/{contact}/favorite', [FavoriteController::class, 'favorite'])->name('favorites.add');
    Route::delete('/favorites/{contact}/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');

    // Route pour afficher les contacts par utilisateur
    Route::get('/contacts/user/{user}', [ContactController::class, 'byUser'])->name('contacts.byUser');

    //Category
    Route::resource('categories', CategoryController::class);
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


    // Route pour filtrer les contacts par catégorie
    Route::get('/contacts/category/{category}', [ContactController::class, 'filterByCategory'])->name('contacts.filterByCategory');

    //statistics
    Route::get('/dashboard/statistics', [DashboardController::class, 'statistics'])->name('dashboard.statistics');

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');


    // Route de recherche des contacts
    Route::get('/contacts/search', [ContactController::class, 'search'])->name('contacts.search');


    //event & calender
    Route::get('/calender', function() { return view('calender.index'); })->name('calender.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');


});

require __DIR__ . '/auth.php';
