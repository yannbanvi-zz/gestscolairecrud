<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NiveauScolaireController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia("Home");
})->name("home");

Route::get('/etudiant', [EtudiantController::class, "index"])->name("etudiant.index");
Route::get('/etudiant/create', [EtudiantController::class, "create"])->name("etudiant.create");
Route::get('/etudiant/edit/{id}', [EtudiantController::class, "edit"])->name("etudiant.edit");

Route::get('/niveauscolaire', [NiveauScolaireController::class, "index"])->name("niveauscolaire.index");
Route::get('/niveauscolaire/edit/{niveauScolaire}', [NiveauScolaireController::class, "edit"])->name("niveauscolaire.edit");
Route::post('/niveauscolaire', [NiveauScolaireController::class, "store"])->name("niveauscolaire.store");
