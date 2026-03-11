<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

//--------------------------------------------------------------------------
// Pages du site
//--------------------------------------------------------------------------
$pages = [
    'accueil' => ['/', 'intro', '01'],
    'presentation' => ['/presentation', 'presentation', '02'],
    'infos' => ['/infos', 'infos', '01'],
    'reservations' => ['/reservations', 'reservations', '03'],
    'concerts' => ['/concerts', 'concerts', '06'],
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
    // CONCERTS
    //*************************************
    Route::get('/concerts', [AdminController::class, 'concerts'])->name('admin.concerts');
    Route::post('/concerts/store', [AdminController::class, 'storeConcerts'])->name('admin.concerts.store');
    Route::patch('/concerts/desactive/{id}', [AdminController::class, 'desactiveTable'])->name('admin.concerts.desactive');
    
    //*************************************
    // TABLES
    //*************************************
    Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::post('/tables/store', [AdminController::class, 'storeTable'])->name('admin.tables.store');
    Route::patch('/tables/desactive/{id}', [AdminController::class, 'desactiveTable'])->name('admin.tables.desactive');
    
    //*************************************
    // QUOTAS
    //*************************************
    Route::get('/quotas', [AdminController::class, 'quotas'])->name('admin.quotas');
    Route::patch('/quotas/update/', [AdminController::class, 'updateQuota'])->name('admin.quotas.updnb');
    
    //*************************************
    // RESERVATIONS
    //*************************************
    Route::get('/reservations', [AdminController::class, 'reservations'])
        ->name('admin.reservations');
    Route::get('/reservations/{date}', [AdminController::class, 'reservations'])
        ->name('admin.reservations');
    Route::post('/reservation/phone', [AdminController::class, 'storePhoneReservation'])
        ->name('admin.resas.storePhone'); // Résas par téléphone
    Route::post('/reservation/web', [AdminController::class, 'storeWebReservation'])
        ->name('admin.resas.storeWeb'); // Résas par téléphone
    Route::patch('/reservation/confirm/{id}', [AdminController::class, 'confirmReservation'])
        ->name('admin.resas.confirm'); // Confirmer résa en ligne
    Route::patch('/reservation/cancel/{id}', [AdminController::class, 'cancelReservation'])
        ->name('admin.resas.cancel'); // Annulation de résérvation
});
