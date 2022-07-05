<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NiveauScolaireController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, "showLogin"])
->middleware("guest")
->name("login");

Route::post("/login", [AuthController::class, "authenticate"])
->middleware("guest")
->name("login.post");



Route::group([
    "middleware" => "auth"
], function(){
    Route::get('/', function () {
        return inertia("Home");
    })->name("home");

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
    
    Route::get('/etudiant', [EtudiantController::class, "index"])->name("etudiant.index");
    Route::post('/etudiant', [EtudiantController::class, "store"])->name("etudiant.store");
    Route::get('/etudiant/create', [EtudiantController::class, "create"])->name("etudiant.create");
    Route::get('/etudiant/edit/{etudiant}', [EtudiantController::class, "edit"])->name("etudiant.edit");
    Route::post('/etudiant/{etudiant}', [EtudiantController::class, "update"])->name("etudiant.update");
    Route::delete('/etudiant/{etudiant}', [EtudiantController::class, "destroy"])->name("etudiant.delete");
    
    Route::get('/niveauscolaire', [NiveauScolaireController::class, "index"])->name("niveauscolaire.index");
    Route::get('/niveauscolaire/edit/{niveauScolaire}', [NiveauScolaireController::class, "edit"])->name("niveauscolaire.edit");
    Route::post('/niveauscolaire', [NiveauScolaireController::class, "store"])->name("niveauscolaire.store");
    Route::put('/niveauscolaire/{niveauScolaire}', [NiveauScolaireController::class, "update"])->name("niveauscolaire.update");
    Route::delete('/niveauscolaire/{niveauScolaire}', [NiveauScolaireController::class, "delete"])->name("niveauscolaire.delete");
});
