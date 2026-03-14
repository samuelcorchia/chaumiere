<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ReservationController;

//--------------------------------------------------------------------------
// Pages statiques du site (closures)
//--------------------------------------------------------------------------
$pages = [
    'accueil' => ['/', 'intro', '01'],
    'presentation' => ['/presentation', 'presentation', '02'],
    'infos' => ['/infos', 'infos', '01'],
    'histoire' => ['/histoire', 'histoire', '04'],
    'privatisation' => ['/privatisation', 'privatisation', '05'],
];
foreach ($pages as $name => [$url, $view, $img]) {
    Route::get($url, function () use ($name, $view, $img) {
        return view($view, [
            'page' => $name,
            'headerbg' => "/images/bg/$img.jpg"
        ]);
    })->name("site.$name");
}

//--------------------------------------------------------------------------
// Page dynamiques du site
//--------------------------------------------------------------------------
Route::get('/concerts', [ConcertController::class, 'index'])->name('site.concerts');
Route::get('/reservations', [ReservationController::class, 'index'])->name('site.reservations');

//--------------------------------------------------------------------------
// Page de login accessible à tous
//--------------------------------------------------------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//--------------------------------------------------------------------------
// Tout le Back-office (les routes ci dessous) est protégé par le middleware 'auth'
//--------------------------------------------------------------------------
Route::middleware(['auth'])->prefix('admin')->group(function () {
    //*************************************
    // TABLES
    //*************************************
    Route::get('/tables', [AdminController::class, 'tables'])
        ->name('admin.tables'); // Lister les tables
    Route::post('/tables/store/', [AdminController::class, 'storeTable'])
        ->name('admin.tables.store'); // Ajouter une table
    Route::patch('/tables/desactive/{id}', [AdminController::class, 'desactiveTable'])
        ->name('admin.tables.desactive'); // Desactiver une table
    
    //*************************************
    // QUOTAS
    //*************************************
    Route::get('/quotas', [AdminController::class, 'quotas'])
        ->name('admin.quotas'); // Lister queota
    Route::patch('/quotas/update', [AdminController::class, 'updateQuota'])
        ->name('admin.quotas.update'); // Modifier quota de tables reservables
    
    //*************************************
    // RESERVATIONS
    //*************************************
    Route::get('/reservations/{date?}', [AdminController::class, 'reservations'])
        ->name('admin.reservations'); // Liste des reservations confirmées ou en attente (par date si renseigné) 
    Route::post('/reservation/store', [AdminController::class, 'storeReservation'])
        ->name('admin.reservations.store'); // Ajouter une reservation WEB (online) ou PHONE (direct)
    Route::patch('/reservation/update', [AdminController::class, 'storeReservation'])
        ->name('admin.reservations.update'); // Modifier une reservation
    Route::patch('/reservation/updateStatus}', [AdminController::class, 'updateReservationStatus'])
        ->name('admin.reservations.updateStatus'); // Confirmer ou annuler une reservation
    
    //*************************************
    // CONCERTS
    //*************************************
    Route::get('/concerts/{date?}', [AdminController::class, 'concerts'])
        ->name('admin.concerts'); // Liste des concert validées ou en attente (par date si renseigné)
    Route::post('/concerts/store', [AdminController::class, 'storeConcert'])
        ->name('admin.concerts.store'); // Ajouter un concert
    Route::patch('/concerts/update', [AdminController::class, 'storeConcert'])
        ->name('admin.concerts.update'); // Modifier un concert
    Route::patch('/concerts/updateStatus', [AdminController::class, 'updateConcertStatus'])
        ->name('admin.concerts.updateStatus'); // Confirmer ou annuler un concert 
});
