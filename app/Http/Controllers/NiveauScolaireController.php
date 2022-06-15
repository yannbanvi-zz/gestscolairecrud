<?php

namespace App\Http\Controllers;

use App\Models\NiveauScolaire;
use Illuminate\Http\Request;

class NiveauScolaireController extends Controller
{
    public function index(){
        $niveauScolaires = NiveauScolaire::latest()->paginate(5);
        return inertia("NiveauScolaire/IndexNiveauScolaire", [
            "niveauScolaires" => $niveauScolaires
        ]);
    }

    public function edit(NiveauScolaire $niveauScolaire){
        return response()->json(["niveauScolaire" => $niveauScolaire]);
    }

    public function store(Request $request){
        $request->validate([
            "nom" => "required|unique:App\\Models\NiveauScolaire"
        ]);

        NiveauScolaire::create(["nom"=> $request->nom]);

        return redirect()->back();
    }
}
