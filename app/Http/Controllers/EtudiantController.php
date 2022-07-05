<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\NiveauScolaire;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;
        $per_page = $request->per_page;

        $etudiants = Etudiant::with("niveau_scolaire")
            ->when($search, function ($query) use ($search) {
                $query->where("nom", "like", "%${search}%");
                $query->orWhere("prenom", "like", "%${search}%");
            })
            ->when($filter, function ($query) use ($filter) {
                $query->where("niveau_scolaire_id", $filter);
            })
            ->latest()
            ->paginate($per_page ?? 5);

        $niveauScolaires = NiveauScolaire::all();

        return inertia("Etudiant/IndexEtudiant", [
            "etudiants" => $etudiants,
            "niveauScolaires" => $niveauScolaires,
            "filtres"  => $request->all("search", "filter", "per_page")
        ]);
    }

    public function create()
    {
        $niveauScolaires = NiveauScolaire::all();

        return inertia("Etudiant/CreateEtudiant", [
            "niveauScolaires" => $niveauScolaires,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "age" => "required",
            "niveauScolaire" => "required|exists:niveau_scolaires,id",
        ]);

        
        try {
            DB::beginTransaction();

            $etudiant = Etudiant::create([...$validatedData, "niveau_scolaire_id" => $request->niveauScolaire]);

            if ($request->hasFile("photo")) {
                $photo = $request->photo;
                $name = $etudiant->nom ." ".$etudiant->prenom;
                $fileName = str_replace(" ", "_", $name);
                $filePath = $photo->storeAs("photos", $fileName, "public");
                $etudiant->photo = $filePath;
                $etudiant->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        return inertia("Etudiant/EditEtudiant");
    }
}
