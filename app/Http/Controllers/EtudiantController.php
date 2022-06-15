<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(){
        $etudiants = Etudiant::with("niveau_scolaire")->latest()->paginate(5);
        return inertia("Etudiant/IndexEtudiant", ["etudiants"=> $etudiants]);
    }

    public function create(){
        return inertia("Etudiant/CreateEtudiant");
    }

    public function edit($id){
        return inertia("Etudiant/EditEtudiant");
    }
}
