<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConcertController;

//--------------------------------------------------------------------------
// Pages du site
//--------------------------------------------------------------------------
$pages = [
    'accueil' => ['/', 'intro', '01'],
    'presentation' => ['/presentation', 'presentation', '02'],
    'infos' => ['/infos', 'infos', '01'],
    'reservations' => ['/reservations', 'reservations', '03'],
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
// Page des concerts
//--------------------------------------------------------------------------
Route::get('/concerts', [ConcertController::class, 'index'])->name('site.concerts');

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
    
    Route::post('/reservation/store/{source}', [AdminController::class, 'storeReservationStatus'])
        ->name('admin.resas.store')
        ->where('source', 'web|phone'); // Ajouter une reservation WEB (online) ou PHONE (direct)
    
    Route::patch('/reservation/updateStatus}', [AdminController::class, 'updateReservationStatus'])
        ->name('admin.resas.updateStatus')
        ->where('action', 'confirm|cancel'); // Confirmer ou annuler une reservation
    
    //*************************************
    // CONCERTS
    //*************************************
    Route::get('/concerts/{date?}', [AdminController::class, 'concerts'])
        ->name('admin.concerts'); // Liste des concert validées ou en attente (par date si renseigné)
    
    Route::post('/concerts/store', [AdminController::class, 'storeConcert'])
        ->name('admin.concerts.store'); // Ajouter un concert
    Route::patch('/concerts/updateStatus', [AdminController::class, 'updateConcertStatus'])
        ->name('admin.concerts.updateStatus'); // Confirmer ou annuler un concert
});
