<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ConcertController;

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

// Déplace cette ligne au-dessus du groupe middleware auth
Route::get('/test-table', [TableController::class, 'index']);

//--------------------------------------------------------------------------
// Tout le Back-office (les routes ci dessous) est protégé par le middleware 'auth'
//--------------------------------------------------------------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // ROUTES POUR LES TABLES
    Route::prefix('tables')->name('tables.')->group(function () {
        Route::get('/', [TableController::class, 'index'])
            ->name('index');
        Route::post('/store', [TableController::class, 'store'])
            ->name('store'); 
        Route::patch('/desactive/{id}', [TableController::class, 'destroy'])
            ->name('desactive'); 
    });
    // QUOTAS
    Route::prefix('quotas')->name('quotas.')->group(function () {
        Route::get('/', [QuotaController::class, 'index'])
            ->name('index');
        Route::patch('/update', [QuotaController::class, 'update'])
            ->name('update');
    });

    //*************************************
    // RESERVATIONS
    //*************************************
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/{date?}', [ReservationController::class, 'list'])
            ->name('index'); // Liste des reservations confirmées ou en attente (par date si renseigné) 
        Route::post('/store', [ReservationController::class, 'store'])
            ->name('store'); // Ajouter une reservation WEB (online) ou PHONE (direct)
        Route::patch('/update', [ReservationController::class, 'store'])
            ->name('update'); // Modifier une reservation
        Route::patch('/updateStatus}', [ReservationController::class, 'updateReservationStatus'])
            ->name('updateStatus'); // Confirmer ou annuler une reservation
    });

    //*************************************
    // CONCERTS
    //*************************************
    Route::prefix('concerts')->name('concerts.')->group(function () {
        Route::get('/{date?}', [ConcertController::class, 'list'])
            ->name('index'); // Liste des concert validées ou en attente (par date si renseigné)
        Route::post('/store', [ConcertController::class, 'store'])
            ->name('store'); // Ajouter un concert
        Route::patch('/update', [ConcertController::class, 'store'])
            ->name('update'); // Modifier un concert
        Route::patch('/updateStatus', [ConcertController::class, 'updateConcertStatus'])
            ->name('updateStatus'); // Confirmer ou annuler un concert 
    });
});
