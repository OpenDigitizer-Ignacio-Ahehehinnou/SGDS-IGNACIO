<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\SuperviseurController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\SignalementController;
use App\Http\Controllers\superAdminController;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EntrepriseZoneController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\RoleController;
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


Route::get('/identifiant', [ProfileController::class, 'username'])->name('username');
Route::post('/identifiant', [ProfileController::class, 'username2'])->name('profil.username2');

Route::get('/code/{username}', [ProfileController::class, 'code'])->name('code');
Route::post('/code', [ProfileController::class, 'code2'])->name('code2');

Route::get('/newPass/{username}', [ProfileController::class, 'newPass'])->name('newPass');
Route::get('/newPass2', [ProfileController::class, 'newPass2'])->name('newPass2');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/logout', [AccueilController::class, 'logout'])->name('logout');

//ACCUEIL

Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
Route::get('/profil', [AccueilController::class, 'profil'])->name('profil');
Route::get('/profilUpdate', [AccueilController::class, 'update'])->name('profil_update');
Route::get('/modifUSer/{userId}', [AccueilController::class, 'modifierUser'])->name('modifier_user');
Route::get('/userModif', [AccueilController::class, 'userModif'])->name('user_modif');


// AUTHENTIFICATION

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handlelogin'])->name('handlelogin');


//ADMINISTRATEUR

Route::get('/admin', [AdministrateurController::class, 'index'])->name('admin');
// Route::get('/admin', [AdministrateurController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
Route::get('/admin/create', [AdministrateurController::class, 'create'])->name('admin.create');
Route::post('/admin/create', [AdministrateurController::class, 'store'])->name('admin.ajouter');
Route::post('/admin', [AdministrateurController::class, 'delete'])->name('admin.supprimer');
Route::put('/admin/{administrateur}', [AdministrateurController::class, 'update'])->name('admin.update');
Route::get('/admin/{administrateur}', [AdministrateurController::class, 'edit'])->name('admin.edit');
Route::get('/admin', [AdministrateurController::class, 'index'])->name('admin');
Route::get('/show/{entreprise}', [AdministrateurController::class, 'detail'])->name('admin.detail');
Route::get('/signalement/{entreprise}', [SignalementController::class, 'detailSignalement'])->name('signalement.detail');
Route::put('/adminD', [AdministrateurController::class, 'desactiver'])->name('admin.desactiver');


// Route::get('/admin/{administrateur}', [AdministrateurController::class,'show'])->name('admin.show');

//SUPERADMIN

Route::get('/superAdmin', [superAdminController::class, 'index'])->name('superAdmin');
Route::get('/superAdmin/create', [superAdminController::class, 'create'])->name('superAdmin.create');
Route::post('/superAdmin/create', [superAdminController::class, 'store'])->name('superAdmin.ajouter');
Route::post('/superAdmin', [superAdminController::class, 'delete'])->name('superAdmin.supprimer');
Route::put('/superAdmin/{superAdmin}', [superAdminController::class, 'update'])->name('superAdmin.update');
Route::get('/superAdmin/{superAdmin}', [superAdminController::class, 'edit'])->name('superAdmin.edit');
Route::get('/superAdmin', [superAdminController::class, 'index'])->name('superAdmin');
Route::get('/Detail', [superAdminController::class, 'detail'])->name('superAdmin.detail');

//SUPERVISEUR

Route::get('/superviseur', [SuperviseurController::class, 'index'])->middleware(['auth', 'verified'])->name('superviseur');
Route::get('/superviseur/create', [SuperviseurController::class, 'create'])->name('superviseur.create');
Route::post('/superviseur/create', [SuperviseurController::class, 'store'])->name('superviseur.ajouter');
Route::post('/superviseur', [SuperviseurController::class, 'delete'])->name('superviseur.supprimer');
Route::put('/superviseur/{superviseur}', [SuperviseurController::class, 'update'])->name('superviseur.update');
Route::get('/superviseur/{superviseur}', [SuperviseurController::class, 'edit'])->name('superviseur.edit');
Route::get('/superviseur', [SuperviseurController::class, 'index'])->name('superviseur');
Route::get('/Detail', [SuperviseurController::class, 'detail'])->name('superviseur.detail');
Route::put('/superviseurD', [SuperviseurController::class, 'desactiver'])->name('superviseur.desactiver');

//COLLECTEUR

Route::get('/collecteur', [CollecteurController::class, 'index'])->middleware(['auth', 'verified'])->name('collecteur');
Route::get('/collecteur/create', [CollecteurController::class, 'create'])->name('collecteur.create');
Route::post('/collecteur/create', [CollecteurController::class, 'store'])->name('collecteur.ajouter');
Route::post('/collecteur', [CollecteurController::class, 'delete'])->name('collecteur.supprimer');
Route::put('/collecteur/{collecteur}', [CollecteurController::class, 'update'])->name('collecteur.update');
Route::get('/collecteur/{collecteur}', [CollecteurController::class, 'edit'])->name('collecteur.edit');
Route::get('/collecteur', [CollecteurController::class, 'index'])->name('collecteur');
Route::get('/Detail', [CollecteurController::class, 'detail'])->name('collecteur.detail');
Route::put('/collecteurD', [CollecteurController::class, 'desactiver'])->name('collecteur.desactiver');

// ENTREPRISE

Route::get('/entreprise', [EntrepriseController::class, 'index'])->name('entreprise');
Route::get('/entrepriseSup', [EntrepriseController::class, 'ListeSupprimer'])->name('entreprise2');

Route::get('/entreprise/create', [EntrepriseController::class, 'create'])->name('entreprise.create');
Route::post('/entreprise/create', [EntrepriseController::class, 'store'])->name('entreprise.ajouter');
Route::post('/entreprise', [EntrepriseController::class, 'delete'])->name('entreprise.supprimer');
Route::put('/entreprise/{entreprise}', [EntrepriseController::class, 'update'])->name('entreprise.update');
Route::get('/entreprise/{entreprise}', [EntrepriseController::class, 'edit'])->name('entreprise.edit');
Route::get('/entreprise', [EntrepriseController::class, 'index'])->name('entreprise');
Route::get('/Detail/{entreprise}', [EntrepriseController::class, 'detail'])->name('entreprise.detail');

// SIGNALEMENT

Route::get('/signalement', [SignalementController::class, 'index'])->middleware(['auth', 'verified'])->name('signalement');
Route::post('/signalement', [SignalementController::class, 'delete'])->name('signalement.supprimer');
Route::get('/signalement', [SignalementController::class, 'index'])->name('signalement');
//Route::get('/Details/{reportingId}', [SignalementController::class, 'detail'])->name('signalement.detail');

//VILLE

Route::get('/ville', [VilleController::class, 'index'])->name('ville');
Route::get('/ville/create', [VilleController::class, 'create'])->name('ville.create');
Route::post('/ville/create', [VilleController::class, 'store'])->name('ville.ajouter');
Route::post('/ville', [VilleController::class, 'delete'])->name('ville.supprimer');
Route::put('/ville/{ville}', [VilleController::class, 'update'])->name('ville.update');
Route::get('/ville/{ville}', [VilleController::class, 'edit'])->name('ville.edit');



//DEPARTEMENT

Route::get('/departementDe', [DepartementController::class, 'index'])->name('departement');
Route::get('/departementAc', [DepartementController::class, 'ListeDesactiver'])->name('departement2');

Route::get('/departement/create', [DepartementController::class, 'create'])->name('departement.create');
Route::post('/departement/create', [DepartementController::class, 'store'])->name('departement.ajouter');
Route::post('/departement', [DepartementController::class, 'delete'])->name('departement.supprimer');
Route::put('/departement/{departement}', [DepartementController::class, 'update'])->name('departement.update');
Route::get('/departement/{departement}', [DepartementController::class, 'edit'])->name('departement.edit');
Route::put('/departementD', [DepartementController::class, 'desactiver'])->name('departement.desactiver');
Route::put('/departementA', [DepartementController::class, 'activer'])->name('departement.activer');



//COMMUNE

Route::get('/communeDe', [CommuneController::class, 'index'])->name('commune');
Route::get('/communeAc', [CommuneController::class, 'ListeDesactiver'])->name('commune2');

Route::get('/commune/create', [CommuneController::class, 'create'])->name('commune.create');
Route::post('/commune/create', [CommuneController::class, 'store'])->name('commune.ajouter');
Route::post('/commune', [CommuneController::class, 'delete'])->name('commune.supprimer');
Route::put('/commune/{commune}', [CommuneController::class, 'update'])->name('commune.update');
Route::put('/communeD', [CommuneController::class, 'desactiver'])->name('commune.desactiver');
Route::put('/communeA', [CommuneController::class, 'activer'])->name('commune.activer');

Route::get('/commune/{commune}', [CommuneController::class, 'edit'])->name('commune.edit');



//ROLE

Route::get('/role', [RoleController::class, 'index'])->name('role');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role/create', [RoleController::class, 'store'])->name('role.ajouter');
Route::post('/role', [RoleController::class, 'delete'])->name('role.supprimer');
Route::put('/role/{roleId}', [RoleController::class, 'update'])->name('role.update');
Route::get('/role/{roleId}', [RoleController::class, 'edit'])->name('role.edit');

//ARRONDISSEMENT

Route::get('/arrondissement', [ArrondissementController::class, 'index'])->name('arrondissement');
Route::get('/arrondissementAc', [ArrondissementController::class, 'ListeDesactiver'])->name('arrondissement2');

Route::get('/arrondissement/create', [ArrondissementController::class, 'create'])->name('arrondissement.create');
Route::post('/arrondissement/create', [ArrondissementController::class, 'store'])->name('arrondissement.ajouter');
Route::post('/arrondissement', [ArrondissementController::class, 'delete'])->name('arrondissement.supprimer');
Route::put('/arrondissement/{arrondissement}', [ArrondissementController::class, 'update'])->name('arrondissement.update');
Route::get('/arrondissement/{arrondissement}', [ArrondissementController::class, 'edit'])->name('arrondissement.edit');
Route::put('/arrondissementD', [ArrondissementController::class, 'desactiver'])->name('arrondissement.desactiver');
Route::put('/arrondissementA', [ArrondissementController::class, 'activer'])->name('arrondissement.activer');



//QUARTIER

Route::get('/quartierD', [QuartierController::class, 'index'])->name('quartier');
Route::get('/quartierAc', [QuartierController::class, 'ListeDesactiver'])->name('quartier2');

Route::get('/quartier/create', [QuartierController::class, 'create'])->name('quartier.create');
Route::post('/quartier/create', [QuartierController::class, 'store'])->name('quartier.ajouter');
Route::post('/quartier', [QuartierController::class, 'delete'])->name('quartier.supprimer');
// Route::put('/quartier/{quartier}', [QuartierController::class, 'update'])->name('quartier.update');
Route::put('/quartier/{quartierId}', [QuartierController::class, 'update'])->name('quartier.update');

Route::get('/quartier/{quartier}', [QuartierController::class, 'edit'])->name('quartier.edit');

Route::put('/quartierD', [QuartierController::class, 'desactiver'])->name('quartier.desactiver');
Route::put('/quartierA', [QuartierController::class, 'activer'])->name('quartier.activer');

//ZONE

Route::get('/zone', [ZoneController::class, 'index'])->name('zone');
Route::get('/zone/create', [ZoneController::class, 'create'])->name('zone.create');
Route::post('/zone/create', [ZoneController::class, 'store'])->name('zone.ajouter');
Route::post('/zone', [ZoneController::class, 'delete'])->name('zone.supprimer');
Route::put('/zone/{zone}', [ZoneController::class, 'update'])->name('zone.update');
Route::get('/zone/{zone}', [ZoneController::class, 'edit'])->name('zone.edit');


//POINT

Route::get('/point', [PointController::class, 'index'])->name('point');
Route::get('/point/create', [PointController::class, 'create'])->name('point.create');
Route::post('/point/create', [PointController::class, 'store'])->name('point.ajouter');


//CATEGORIE

Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie');
Route::get('/categorie/create', [CategorieController::class, 'create'])->name('categorie.create');
Route::post('/categorie/create', [CategorieController::class, 'store'])->name('categorie.ajouter');
Route::post('/categorie', [CategorieController::class, 'delete'])->name('categorie.supprimer');
Route::put('/categorie/{categorie}', [CategorieController::class, 'update'])->name('categorie.update');
Route::get('/categorie/{categorie}', [CategorieController::class, 'edit'])->name('categorie.edit');
