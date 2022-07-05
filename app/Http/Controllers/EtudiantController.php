<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\NiveauScolaire;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $filter = $request->filter;
        $per_page = $request->per_page;

        $etudiants = Etudiant::with("niveau_scolaire")
        ->when($search, function($query) use($search){
            $query->where("nom", "like", "%${search}%");
            $query->orWhere("prenom", "like", "%${search}%");
        })
        ->when($filter, function($query) use($filter){
            $query->where("niveau_scolaire_id", $filter);
        })
        ->latest()
        ->paginate($per_page ?? 5);

        $niveauScolaires = NiveauScolaire::all();

        return inertia("Etudiant/IndexEtudiant", [
            "etudiants"=> $etudiants,
            "niveauScolaires" => $niveauScolaires,
            "filtres"  => $request->all("search", "filter", "per_page")
        ]);
    }

    public function create(){
        $niveauScolaires = NiveauScolaire::all();

        return inertia("Etudiant/CreateEtudiant", [
            "niveauScolaires" => $niveauScolaires,
        ]);
    }

    public function edit($id){
        return inertia("Etudiant/EditEtudiant");
    }
}
