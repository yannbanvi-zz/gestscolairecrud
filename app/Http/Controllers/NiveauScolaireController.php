<?php

namespace App\Http\Controllers;

use App\Models\NiveauScolaire;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function update(Request $request, NiveauScolaire $niveauScolaire){
        $request->validate([
            "nom" => [
                "required",
                Rule::unique((new NiveauScolaire)->getTable(), "nom")->ignore($niveauScolaire->id)
            ]
            ]);

            if($request->nom != $niveauScolaire->nom){
                $niveauScolaire->nom = $request->nom;
                $niveauScolaire->save();
            }
            return redirect()->back();
    }
}
