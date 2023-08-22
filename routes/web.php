<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\SuperviseurController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\SignalementController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ZoneController;
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

// ATTENTION TU PEUX ENLEVER LE COMMENTAIRE A N'IMPORTE QUEL MOMENT

// Route::get('/', function () {
//     return view('auth/login');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
Route::get('/profil', [AccueilController::class, 'profil'])->name('profil');



// le retour 
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handlelogin'])->name('handlelogin');



Route::get('/admin', [AdministrateurController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');


Route::get('/admin', [AdministrateurController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
Route::get('/admin/create', [AdministrateurController::class, 'create'])->name('admin.create');
Route::post('/admin/create', [AdministrateurController::class, 'store'])->name('admin.ajouter');
Route::delete('/admin/{administrateur}', [AdministrateurController::class, 'delete'])->name('admin.supprimer');
Route::put('/admin/{administrateur}', [AdministrateurController::class, 'update'])->name('admin.update');
Route::get('/admin/{administrateur}', [AdministrateurController::class, 'edit'])->name('admin.edit');

Route::get('/admin', [AdministrateurController::class, 'index'])->name('admin');
// Route::get('/admin/{administrateur}', [AdministrateurController::class,'show'])->name('admin.show');


Route::get('/superviseur', [SuperviseurController::class, 'index'])->middleware(['auth', 'verified'])->name('superviseur');
Route::get('/superviseur/create', [SuperviseurController::class, 'create'])->name('superviseur.create');
Route::post('/superviseur/create', [SuperviseurController::class, 'store'])->name('superviseur.ajouter');
Route::delete('/superviseur/{superviseur}', [SuperviseurController::class, 'delete'])->name('superviseur.supprimer');
Route::put('/superviseur/{superviseur}', [SuperviseurController::class, 'update'])->name('superviseur.update');
Route::get('/superviseur/{superviseur}', [SuperviseurController::class, 'edit'])->name('superviseur.edit');
Route::get('/superviseur', [SuperviseurController::class, 'index'])->name('superviseur');
Route::get('/Detail', [SuperviseurController::class, 'detail'])->name('superviseur.detail');

Route::get('/collecteur', [CollecteurController::class, 'index'])->middleware(['auth', 'verified'])->name('collecteur');
Route::get('/collecteur/create', [CollecteurController::class, 'create'])->name('collecteur.create');
Route::post('/collecteur/create', [CollecteurController::class, 'store'])->name('collecteur.ajouter');
Route::delete('/collecteur/{collecteur}', [CollecteurController::class, 'delete'])->name('collecteur.supprimer');
Route::put('/collecteur/{collecteur}', [CollecteurController::class, 'update'])->name('collecteur.update');
Route::get('/collecteur/{collecteur}', [CollecteurController::class, 'edit'])->name('collecteur.edit');
Route::get('/collecteur', [CollecteurController::class, 'index'])->name('collecteur');
Route::get('/Detail', [CollecteurController::class, 'detail'])->name('collecteur.detail');

// ENTREPRISE

Route::get('/entreprise', [EntrepriseController::class, 'index'])->middleware(['auth', 'verified'])->name('entreprise');
Route::get('/entreprise/create', [EntrepriseController::class, 'create'])->name('entreprise.create');
Route::post('/entreprise/create', [EntrepriseController::class, 'store'])->name('entreprise.ajouter');
Route::delete('/entreprise/{entreprise}', [EntrepriseController::class, 'delete'])->name('entreprise.supprimer');
Route::put('/entreprise/{entreprise}', [EntrepriseController::class, 'update'])->name('entreprise.update');
Route::get('/entreprise/{entreprise}', [EntrepriseController::class, 'edit'])->name('entreprise.edit');
Route::get('/entreprise', [EntrepriseController::class, 'index'])->name('entreprise');
Route::get('/Detail', [EntrepriseController::class, 'detail'])->name('entreprise.detail');

// SIGNALEMENT

Route::get('/signalement', [SignalementController::class, 'index'])->middleware(['auth', 'verified'])->name('signalement');
Route::get('/signalement/create', [SignalementController::class, 'create'])->name('signalement.create');
Route::post('/signalement/create', [SignalementController::class, 'store'])->name('signalement.ajouter');
Route::delete('/signalement/{signalement}', [SignalementController::class, 'delete'])->name('signalement.supprimer');
Route::put('/signalement/{signalement}', [SignalementController::class, 'update'])->name('signalement.update');
Route::get('/signalement/{signalement}', [SignalementController::class, 'edit'])->name('signalement.edit');
Route::get('/signalement', [SignalementController::class, 'index'])->name('signalement');
Route::get('/Detail/{reportingId}', [SignalementController::class, 'detail'])->name('signalement.detail');

//VILLE

Route::get('/ville', [VilleController::class, 'index'])->name('ville');
Route::get('/ville/create', [VilleController::class, 'create'])->name('ville.create');
Route::post('/ville/create', [VilleController::class, 'store'])->name('ville.ajouter');
Route::delete('/ville/{ville}', [VilleController::class, 'delete'])->name('ville.supprimer');
Route::put('/ville/{ville}', [VilleController::class, 'update'])->name('ville.update');
Route::get('/ville/{ville}', [VilleController::class, 'edit'])->name('ville.edit');


//ZONE

Route::get('/zone', [ZoneController::class, 'index'])->name('zone');
Route::get('/zone/create', [ZoneController::class, 'create'])->name('zone.create');
Route::post('/zone/create', [ZoneController::class, 'store'])->name('zone.ajouter');
Route::delete('/zone/{zone}', [ZoneController::class, 'delete'])->name('zone.supprimer');
Route::put('/zone/{zone}', [ZoneController::class, 'update'])->name('zone.update');
Route::get('/zone/{zone}', [ZoneController::class, 'edit'])->name('zone.edit');


//POINT

Route::get('/point', [PointController::class, 'index'])->name('point');
Route::get('/point/create', [PointController::class, 'create'])->name('point.create');
Route::post('/point/create', [PointController::class, 'store'])->name('point.ajouter');
